<?php

namespace App\Services;

use App\Repositories\PatientRepository\PatientRepositoryInterface;

class PatientService
{
    public function __construct(protected PatientRepositoryInterface $patientRepository)
    {
    }

    public function all()
    {
        return $this->patientRepository->all();
    }

    public function find($id)
    {
        return $this->patientRepository->find($id);
    }

    public function create(array $data)
    {
        return $this->patientRepository->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->patientRepository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->patientRepository->delete($id);
    }
}
