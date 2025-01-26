<?php

namespace App\Repositories;

use App\Repositories\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use MatanYadaev\EloquentSpatial\Objects\Point;

abstract class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @return string
     */
    abstract public function getModelName(): string;

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return app($this->getModelName());
    }

    /**
     * @param array $queries
     * @param array $relations
     * @param array $triggers
     * @return LengthAwarePaginator|Collection
     */
    public function list(array $queries = [], array $relations = [], array $triggers = []): LengthAwarePaginator|Collection
    {
        $models = $this->getModel()->query()->with($relations);
        if (isset($triggers['order_by'])) {
            $models = $models->orderBy('id', $triggers['order_by']);
        } else {
            $models = $models->orderBy('id', 'DESC');
        }
        if(isset($triggers['latest'])) {
            $models = $models->latest($triggers['latest']);
        }
        if(isset($queries['with_trashed'])) {
            $models = $models->withTrashed();
        }
        if(isset($triggers['limit']) && is_int($triggers['limit'])) {
            $models = $models->take($triggers['limit']);
        }
        if (isset($triggers['paginate']) && $triggers['paginate']) {
            return $this->applyQuery($models, $queries)->paginate($triggers['paginate']);
        }
        return $this->applyQuery($models, $queries)->get();
    }

    public function pluck(array $queries, string $column, string $index = null): array {
        $models = $this->getModel()->query();
        if($index === null) {
            return $this->applyQuery($models, $queries)->pluck($column)->toArray();
        }
        return $this->applyQuery($models, $queries)->pluck($column, $index)->toArray();
    }

    /**
     * @param array $parameters
     * @return Model
     */
    public function create(array $parameters): Model
    {
        return $this->getModel()->query()->create($parameters);
    }

    /**
     * @param array $attributes
     * @param array $values
     * @return Builder|Model|mixed
     */
    public function firstOrCreate(array $attributes = [], array $values = [])
    {
        return $this->getModel()->query()->firstOrCreate($attributes, $values);
    }

    /**
     * @param int $id
     * @param array $relations
     * @return Model|null
     */
    public function find(int $id, array $relations = []): ?Model
    {
        return $this->getModel()->query()->with($relations)->find($id);
    }

    /**
     * @param int $id
     * @param array $relations
     * @return Model|null
     */
    public function findOrFail(int $id, array $relations = [])
    {
        return $this->getModel()->query()->with($relations)->findOrFail($id);
    }

    /**
     * @param array $queries
     * @param array $relations
     * @return Model|null
     */
    public function first(array $queries, array $relations = [])
    {
        $models = $this->getModel()->query()->with($relations);
        return $this->applyQuery($models, $queries)->first();
    }

    /**
     * @param array $queries
     * @param array $relations
     * @return Model|null
     */
    public function firstOrFail(array $queries, array $relations = [])
    {
        $models = $this->getModel()->query()->with($relations);
        return $this->applyQuery($models, $queries)->firstOrFail();
    }

    /**
     * @param Model $model
     * @param array $parameters
     * @return Model
     */
    public function update(Model $model, array $parameters): Model
    {
        if(isset($parameters['lock'])) {
            if($parameters['forUpdate']) {
                $model->lockForUpdate();
            } elseif($parameters['shared']) {
                $model->sharedLocked();
            }
            unset($parameters['lock']);
        }
        $model->update($parameters);
        return $model->refresh();
    }

    public function updateById(int|string $id, array $parameters): ?Model
    {
        $result = $this->getModel()->query()
                ->where('id', $id)
                ->update($parameters) > 0;

        return $result ? $this->find($id) : null;
    }

    /**
     * @param $latitude
     * @param $longitude
     * @return mixed
     */
    public function convertToLocation($latitude, $longitude): Point
    {
        return new Point($latitude, $longitude);
    }

    /**
     * @param array $queries
     * @return int
     */
    public function count(array $queries = []): int
    {
        $models = $this->getModel()->query();
        if(isset($queries['with_trashed'])) {
            $models = $models->withTrashed();
        }
        return $this->applyQuery($models, $queries)->count();
    }

    /**
     * @param Builder $model
     * @return mixed
     */
    public function destroy(Builder $model)
    {
        return $model->destroy();
    }

    /**
     * @param Builder $model
     * @return mixed
     */
    public function forceDelete(Builder $model)
    {
        return $model->forceDelete();
    }

    /**
     * @param int|string $id
     * @return bool
     */
    public function destroyById(int|string $id): bool
    {
        return $this->getModel()->query()
            ->where('id', $id)
            ->delete();
    }

    /**
     * @param Builder $models
     * @param array $queries
     * @return Builder
     */
    public function applyQuery(Builder $models, array $queries = []): Builder
    {
        foreach ($queries as $column => $value) {
            if($column == 'whereNull') {
                $models->whereNull($value);
            } elseif($column == 'whereNotNull') {
                $models->whereNotNull($value);
            } else {
                $models->where($column, $value);
            }
        }
        return $models;
    }

    /**
     * @param Model $model
     * @return mixed
     */
    public function delete(Model $model)
    {
        return $model->delete();
    }

    /**
     * @param Model $model
     * @return mixed
     */
    public function restore(Model $model)
    {
        return $model->restore();
    }

    /**
     * @param Model $model
     * @return bool
     */
    public function notDeleted(Model $model): bool
    {
        return $model->query()->whereNull('deleted_at')->exists();
    }

    /**
     * @param Model $model
     * @return bool
     */
    public function deleted(Model $model): bool
    {
        return $model->query()->whereNotNull('deleted_at')->exists();
    }

    public function search(array $columns, int $limit = 100)
    {
        $query = $this->getModel()->query();
        foreach($columns as $column => $value) {
            $query->where($column, 'LIKE', "%{$value}%");;
        }
        return $query->take($limit)->get();
    }

    public function idsBySearch(array $columns, int $limit = 100)
    {
        $query = $this->getModel()->query();
        foreach($columns as $column => $value) {
            $query->where($column, 'LIKE', "%{$value}%");;
        }
        return $query->take($limit)->pluck('id')->toArray();
    }

    public function load(Model $model, array $relations = [])
    {
        return $model->load($relations);
    }
}
