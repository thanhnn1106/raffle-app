<?php

namespace App\Repositories\Eloquent;

use App\Repositories\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    /**
     * BaseRepository constructor.
     */
    public function __construct(private Model $model)
    {
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function find(int $id)
    {
        return $this->model->find($id);
    }

    public function update(int $id, array $attribute)
    {
        return $this->model->where('id', $id)->update($attribute);
    }

    public function findOneBy(string $key, $value): ?Model
    {
        return $this->model->where($key, $value)->first();
    }
}
