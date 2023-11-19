<?php

namespace App\Abstracts;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

abstract class BaseCrudRepository
{
    /**
     * The model instance.
     * 
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected Model $model;
    
    /**
     * The fields that should be filtered.
     * 
     * @var array
     */
    protected array $filterable = [];

    /**
     * Create a new repository instance.
     * 
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get all the records.
     * 
     * @param ?array $columns|null
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(?array $columns = ['*']): \Illuminate\Database\Eloquent\Collection
    {
        return $this->model->select($columns)->get();
    }

    /**
     * Get the record by id.
     * 
     * @param int|string $id
     * @param Callable $callback
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find(int|string $id, Callable $callback = null)
    {
        return $this->model->findOr($id, $callback);
    }

    /**
     * Get the record by a specific column.
     * 
     * @param string $column
     * @param mixed $value
     * @param Callable $callback
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findBy(string $column, mixed $value, Callable $callback = null)
    {
        return $this->model->where($column, $value)->firstOr($callback);
    }

    /**
     * Create a new record.
     * 
     * @param ?User|null $user
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    // abstract public function create(?User $user, array $data): Model;

    /**
     * Update the record by id.
     * 
     * @param int $id
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id, array $data)
    {
        $record = $this->find($id);

        $record->update($data);

        return $record;
    }

    /**
     * Delete the record by id.
     * 
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $this->model->destroy($id);
    }

    /**
     * Get the collection of records with pagination.
     * 
     * @param int $perPage
     * @param array $columns
     * @param string $pageName
     * @param int|null $page
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate(int $perPage = 15, array $columns = ['*'], string $pageName = 'page', int $page = null)
    {
        return $this->model->paginate($perPage, $columns, $pageName, $page);
    }

    /**
     * Get the collection of records with pagination and filtering.
     * 
     * @param array $filters
     * @param int $perPage
     * @param array $columns
     * @param string $pageName
     * @param int|null $page
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginateWithFilters(array $filters, int $perPage = 15, array $columns = ['*'], string $pageName = 'page', int $page = null)
    {
        $query = $this->model->newQuery();

        foreach ($filters as $column => $value) {
            if (in_array($column, $this->filterable)) {
                $query->where($column, $value);
            }
        }

        return $query->paginate($perPage, $columns, $pageName, $page);
    }

    /**
     * Get the model instance.
     * 
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel()
    {
        return $this->model;
    }
}