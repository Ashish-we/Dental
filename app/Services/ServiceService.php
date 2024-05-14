<?php

namespace App\Services;

use App\Repositories\ServiceRepository\ServiceRepositoryInterface;

class ServiceService
{
    public function __construct(protected ServiceRepositoryInterface $ServiceRepository)
    {
    }

    public function all()
    {
        return $this->ServiceRepository->all();
    }

    public function find($id)
    {
        return $this->ServiceRepository->find($id);
    }

    public function create(array $data)
    {
        return $this->ServiceRepository->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->ServiceRepository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->ServiceRepository->delete($id);
    }
}
