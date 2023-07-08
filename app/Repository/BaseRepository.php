<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getQuery(): Builder
    {
        return $this->model->query();
    }

    /**
     * returns the first record
     */
    public function first()
    {
        return $this->getQuery()->firstOrFail();
    }

    /**
     * returns all the records 
     */
    public function all(): Collection
    {
        return $this->getQuery()->get();
    }

    /**
     * returns an integer count value
     */
    public function count(): int
    {
        return $this->getQuery()->count();
    }

    /**
     * returns a paginated data 
     */
    public function paginate($limit = 10)
    {
        return $this->getQuery()->paginate($limit);
    }

    /**
     * returns record if found otherwise returns null
     */
    public function find($id, $withTrash = false)
    {
        if ($withTrash) {
            return $this->getQuery()->withTrashed()->findOrFail($id);
        }

        return $this->getQuery()->findOrFail($id);
    }

    /**
     * query builder to filter results
     */
    public function where($column, $filter): BUilder
    {
        return $this->getQuery()->where($column, $filter);
    }

    /**
     * method to create record
     */
    public function create(array $request)
    {
        return $this->getQuery()->create($request);
    }

    /**
     * query builder to eager load relationship
     */
    public function with($relation): Builder
    {
        return $this->getQuery()->with($relation);
    }

    /**
     * method to update records in database
     */
    public function update($id, array $request, $withTrash = false)
    {
        if ($withTrash) {
            $app = $this->getQuery()->withTrashed()->findOrFail($id);
        } else {
            $app = $this->getQuery()->findOrFail($id);
        }

        $app->update($request);

        return $app;
    }

    /**
     * method to delete records in database
     */
    public function delete($id): bool
    {
        return $this->getQuery()->findOrFail($id)->delete();
    }
}
