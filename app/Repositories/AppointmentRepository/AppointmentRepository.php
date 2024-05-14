<?php

namespace App\Repositories\AppointmentRepository;

use App\Models\Appointment;

class AppointmentRepository implements AppointmentRepositoryInterface
{
    public function all()
    {
        return Appointment::all();
    }

    public function find($id)
    {
        return Appointment::findOrFail($id);
    }

    public function create(array $data)
    {
        return Appointment::create($data);
    }

    public function update(array $data, $id)
    {
        $dentist = Appointment::findOrFail($id);
        $dentist->update($data);

        return $dentist;
    }

    public function delete($id)
    {
        $dentist = Appointment::findOrFail($id);
        $dentist->delete();
    }
}
