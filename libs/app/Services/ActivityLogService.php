<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\ActivityLogger;

class ActivityLogService
{
    protected $activityLogger;
    protected $data = [];
    protected $model;
    protected $description;
    protected $logName = 'پیش فرض';
    protected $logOnly;

    public function __construct(ActivityLogger $activityLogger)
    {
        $this->activityLogger = $activityLogger;
    }
    
    /**
     * Prepare the model data for comparison.
     *
     * @param Model $model
     * @param string $state
     * @return self
     */
    public function prepare(Model $model, string $state = 'new'): self
    {
        $model->refresh();
        $logOnly = $model->getLogOnly();
        $this->logOnly = $logOnly;
        $authUser = auth()->user();
        
        if(!$this->model) {
            $this->model = $model;
            $this->description = $model->heading ?? $model->name ?? $model->title;
            $this->data['alert'] = $this->logName
                            . ' <strong>'
                            . $this->description
                            . '</strong>'
                            . ' در تاریخ '
                            . jdate(now())->format('d F Y ساعت H:i')
                            . ' توسط '
                            . ' <strong>'
                            . $authUser?->name
                            . '</strong> '
                            . $this->actionFa
                            . ' است. ';
        }

        collect($model->getAttributes())
            ->filter(function ($value, $key) use ($logOnly) {
                return in_array($key, $logOnly);
            })
            ->each(function ($value, $key) use ($state, $model) {
                $this->temp[$key][$state] = $value;
                $this->temp[$key]['name'] = $model->getLabel($key);
                $this->temp[$key]['type'] = $model->getFieldType($key);
            });
            
        $this->temp['relations'][$state] = $this->prepareRelations($model, $state);

        return $this;
    }
    
    public function prepareRelations(Model $model, string $state): array
    {
        $logRelations = $model->getLogRelations() ?? [];
        $relationsToLoad = array_keys($logRelations);
    
        // Load all relations
        $model->load($relationsToLoad);
    
        $relationsData = [];
        foreach ($logRelations as $relationName => $fields) {
            if (!$model->relationLoaded($relationName)) {
                continue;
            }
    
            $relationData = $model->$relationName;
    
            if ($relationData instanceof \Illuminate\Database\Eloquent\Collection) {
                $relationsData[$relationName] = $relationData->mapWithKeys(function ($item) use ($fields) {
                    return [$item->id => $this->extractDynamicKeys($item->toArray(), $fields)];
                })->toArray();
            } elseif ($relationData instanceof Model) {
                $relationsData[$relationName] = [
                    $relationData->id => $this->extractDynamicKeys($relationData->toArray(), $fields),
                ];
            }
        }
    
        return $relationsData;
    }
    
    /**
     * Extract dynamic keys from the given data array based on specified keys.
     *
     * @param array $data
     * @param array $keysToAccess
     * @return array
     */
    private function extractDynamicKeys(array $data, array $keysToAccess): array
    {
        $result = [];
    
        foreach ($keysToAccess as $key => $value) {
            if (is_array($value)) {
                if (isset($data[$key])) {
                    $result[$key] = $this->extractDynamicKeys($data[$key], $value);
                }
            } elseif (is_string($value) && isset($data[$value])) {
                $result[$value] = $data[$value];
            }
        }
    
        return $result;
    }
    
    /**
     * Finalize the data comparison and prepare it for logging.
     *
     * @return self
     */
    public function finalize(): self
    {
        $logOnly = $this->logOnly;
        $this->data['model'] = collect($this->temp)
            ->filter(function ($fields, $key) use ($logOnly) {
                return in_array($key, $logOnly);
            })
            ->mapWithKeys(function ($fields, $key) {
                $old = $fields['old'] ?? null;
                $new = $fields['new'] ?? null;
    
                return [
                    $key => [
                        'name' => $fields['name'],
                        'old' => $old,
                        'new' => $new,
                        'type' => $fields['type'],
                        'is_changed' => $old !== $new,
                    ],
                ];
            })
            ->toArray();
            
        $this->data['relations'] = collect($this->temp['relations']['old'] ?? [])
            ->mapWithKeys(function ($oldItems, $relationName) {
                $newItems = $this->temp['relations']['new'][$relationName] ?? [];
    
                return [
                    $relationName => collect($oldItems)
                        ->mapWithKeys(function ($oldData, $id) use ($newItems) {
                            $newData = $newItems[$id] ?? null;
    
                            return [
                                $id => [
                                    'old' => $oldData,
                                    'new' => $newData,
                                    'is_changed' => $oldData !== $newData,
                                ],
                            ];
                        })
                        ->toArray(),
                ];
            })
            ->toArray();
    
        return $this;
    }
    
    /**
     * Initialize the log with model information and attributes.
     *
     * @param string $name
     * @param string $action
     * @return self
     */
    public function init(string $name, string $action = 'created')
    {
        $this->logName = $name;
        $this->actionFa = match($action) {
            'created' => 'ایجاد',
            'updated' => 'بروزرسانی',
            'deleted' => 'حذف',
            default => 'پیش فرض',
        };
        $this->data['action-fa'] = $this->actionFa;
        $this->data['action'] = $action;
        
        return $this;
    }

    /**
     * Add extra custom data to the log.
     *
     * @param string $name
     * @param array $data
     * @return self
     */
    public function add(string $name, array $data): self
    {
        $this->data['extra'][$name] = $data;

        return $this;
    }

    /**
     * Save the log to the database.
     *
     * @return void
     */
    public function save(): void
    {
        $this->activityLogger
            ->useLog($this->logName)
            ->performedOn($this->model)
            ->causedBy(auth()->user())
            ->withProperties($this->data)
            ->log($this->description);
    }
}
