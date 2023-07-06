<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRespository
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
        return $this->getQuery()->first();
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
            return $this->getQuery()->withTrashed()->find($id);
        }

        return $this->getQuery()->find($id);
    }

    /**
     * query builder to filter results
     */
    public function where($column, $id, $first = false)
    {
        $query = $this->getQuery()->where($column, $id);

        return ($first) ? $query->first() : $query->get();
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
            $app = $this->getQuery()->withTrashed()->find($id);
        } else {
            $app = $this->getQuery()->find($id);
        }

        $app->update($request);

        return $app;
    }

    /**
     * method to delete records in database
     */
    public function delete($id): bool
    {
        return $this->getQuery()->find($id)->delete();
    }
}
