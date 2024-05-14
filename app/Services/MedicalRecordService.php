<?php

namespace App\Services;

use App\Repositories\MedicalRecordRepository\MedicalRecordRepositoryInterface;

class MedicalRecordService
{
    public function __construct(protected MedicalRecordRepositoryInterface $medicalRecordRepository)
    {
    }

    public function all()
    {
        return $this->medicalRecordRepository->all();
    }

    public function find($id)
    {
        return $this->medicalRecordRepository->find($id);
    }

    public function create(array $data)
    {
        return $this->medicalRecordRepository->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->medicalRecordRepository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->medicalRecordRepository->delete($id);
    }
}
