<?php

namespace App\Services;

use App\Repositories\DentistRepository\DentistRepositoryInterface;

class DentistService
{
    public function __construct(protected DentistRepositoryInterface $dentistRepository)
    {
    }

    public function all()
    {
        return $this->dentistRepository->all();
    }

    public function find($id)
    {
        return $this->dentistRepository->find($id);
    }

    public function create(array $data)
    {
        return $this->dentistRepository->create($data);
    }

    public function update(array $data, $id, $user_id)
    {
        return $this->dentistRepository->update($data, $id, $user_id);
    }

    public function delete($id)
    {
        return $this->dentistRepository->delete($id);
    }
}
