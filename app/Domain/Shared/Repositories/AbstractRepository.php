<?php

namespace App\Domain\Shared\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find(int $id): ?Model
    {
        return $this->model->find($id);
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): ?Model
    {
        $model = $this->find($id);

        if ($model) {
            $model->update($data);
        }

        return $model;
    }

    public function delete(int $id): bool
    {
        $model = $this->find($id);

        return $model ? $model->delete() : false;
    }

    public function search(string $data)
    {
        return $this->model->where('name', 'like', "%$data%")->get();
    }
}
