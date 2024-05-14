<?php

namespace App\Repositories\PatientRepository;

use App\Models\Patient;

class PatientRepository implements PatientRepositoryInterface
{
    public function all()
    {
        return Patient::latest();
    }

    public function find($id)
    {
        $patient = Patient::find($id);
        return $patient;
    }

    public function create(array $data)
    {
        return Patient::create($data);
    }

    public function update(array $data, $id)
    {
        $dentist = Patient::findOrFail($id);
        $dentist->update($data);

        return $dentist;
    }

    public function delete($id)
    {
        $dentist = Patient::findOrFail($id);
        $dentist->delete();
    }
}
