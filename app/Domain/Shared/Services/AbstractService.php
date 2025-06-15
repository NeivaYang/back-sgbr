<?php

namespace App\Domain\Shared\Services;

abstract class AbstractService
{
    protected $repository;

    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function listAll()
    {
        return $this->repository->all();
    }

    public function findById(int $id)
    {
        return $this->repository->find($id);
    }

    public function create(array $data)
    {
        $data = $this->beforeCreate($data);

        $entity = $this->repository->create($data);

        $this->afterCreate($entity);

        return $entity;
    }

    public function update(int $id, array $data)
    {
        $data = $this->beforeUpdate($id, $data);

        $entity = $this->repository->update($id, $data);

        $this->afterUpdate($entity);

        return $entity;
    }

    public function delete(int $id)
    {
        return $this->repository->delete($id);
    }

    public function search(string $data)
    {
        return $this->repository->search($data);
    }

    /**
     * Lógica executada antes de criar um recurso.
     *
     * @param array $data
     * @return array
     */
    protected function beforeCreate(array $data): array
    {
        // Sobrescreva este método em serviços concretos para adicionar lógica personalizada.
        return $data;
    }

    /**
     * Lógica executada após a criação de um recurso.
     *
     * @param mixed $entity
     * @return void
     */
    protected function afterCreate($entity): void
    {
        // Sobrescreva este método em serviços concretos para adicionar lógica personalizada.
    }

    /**
     * Lógica executada antes de atualizar um recurso.
     *
     * @param int $id
     * @param array $data
     * @return array
     */
    protected function beforeUpdate(int $id, array $data): array
    {
        // Sobrescreva este método em serviços concretos para adicionar lógica personalizada.
        return $data;
    }

    /**
     * Lógica executada após a atualização de um recurso.
     *
     * @param mixed $entity
     * @return void
     */
    protected function afterUpdate($entity): void
    {
        // Sobrescreva este método em serviços concretos para adicionar lógica personalizada.
    }

    /**
     * Verifica se existe ou cria um registro.
     *
     * @param array $conditions
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function firstOrCreate(array $conditions, array $data)
    {
        $record = $this->repository->search($conditions)->first();

        if ($record) {
            return $record;
        }

        return $this->repository->create(array_merge($conditions, $data));
    }
}
