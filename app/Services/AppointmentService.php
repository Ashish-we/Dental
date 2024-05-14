<?php

namespace App\Services;

use App\Repositories\AppointmentRepository\AppointmentRepositoryInterface;

class AppointmentService
{
    public function __construct(protected AppointmentRepositoryInterface $appointmentRepository)
    {
    }

    public function all()
    {
        return $this->appointmentRepository->all();
    }

    public function find($id)
    {
        return $this->appointmentRepository->find($id);
    }

    public function create(array $data)
    {
        return $this->appointmentRepository->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->appointmentRepository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->appointmentRepository->delete($id);
    }
}
