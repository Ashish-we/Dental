<?php

namespace App\Repositories\MedicalRecordRepository;

use App\Models\MedicalRecord;

class MedicalRecordRepository implements MedicalRecordRepositoryInterface
{
    public function all()
    {
        return MedicalRecord::latest();
    }

    public function find($id)
    {
        return MedicalRecord::findOrFail($id);
    }

    public function create(array $data)
    {
        return MedicalRecord::create($data);
    }

    public function update(array $data, $id)
    {
        $dentist = MedicalRecord::findOrFail($id);
        $dentist->update($data);

        return $dentist;
    }

    public function delete($id)
    {
        $dentist = MedicalRecord::findOrFail($id);
        $dentist->delete();
    }
}
