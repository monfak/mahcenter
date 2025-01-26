<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface BaseRepositoryInterface
{
    /**
     * @param array $queries
     * @param array $relations
     * @param array $triggers
     * @return LengthAwarePaginator|Collection
     */
    public function list(array $queries = [], array $relations = [], array $triggers = []): LengthAwarePaginator|Collection;

    public function pluck(array $queries, string $column, string $index = null): array;

    /**
     * @param array $parameters
     * @return Model
     */
    public function create(array $parameters): Model;

    /**
     * @param array $attributes
     * @param array $values
     * @return mixed
     */
    public function firstOrCreate(array $attributes = [], array $values = []);

    /**
     * @param int $id
     * @param array $relations
     * @return Model|null
     */
    public function find(int $id, array $relations = []): ?Model;

    /**
     * @param int $id
     * @param array $relations
     * @return Model|null
     */
    public function findOrFail(int $id, array $relations = []);

    /**
     * @param array $queries
     * @param array $relations
     * @return Model|null
     */
    public function first(array $queries, array $relations = []);

    /**
     * @param array $queries
     * @param array $relations
     * @return Model|null
     */
    public function firstOrFail(array $queries, array $relations = []);

    /**
     * @param Model $model
     * @param array $parameters
     * @return Model
     */
    public function update(Model $model, array $parameters): Model;

    public function updateById(int|string $id, array $parameters): ?Model;

    public function convertToLocation($latitude, $longitude);

    public function count(array $queries = []): int;

    /**
     * @param Builder $model
     * @return mixed
     */
    public function destroy(Builder $model);

    /**
     * @param Model $model
     * @return mixed
     */
    public function delete(Model $model);

    /**
     * @param Model $model
     * @return mixed
     */
    public function restore(Model $model);

    public function notDeleted(Model $model): bool;

    public function deleted(Model $model): bool;

    public function destroyById(int|string $id): bool;

    /**
     * @param Builder $models
     * @param array $queries
     * @return Builder
     */
    public function applyQuery(Builder $models, array $queries = []): Builder;

    public function search(array $columns, int $limit = 100);

    public function load(Model $model, array $relations = []);
}
