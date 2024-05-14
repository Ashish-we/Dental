<?php

namespace App\Repositories\ServiceRepository;


use App\Models\Service;

class ServiceRepository implements ServiceRepositoryInterface
{
    public function all()
    {
        return Service::all();
    }

    public function find($id)
    {
        return Service::findOrFail($id);
    }

    public function create(array $data)
    {
        return Service::create($data);
    }

    public function update(array $data, $id)
    {
        $dentist = Service::findOrFail($id);
        $dentist->update($data);

        return $dentist;
    }

    public function delete($id)
    {
        $dentist = Service::findOrFail($id);
        $dentist->delete();
    }
}
