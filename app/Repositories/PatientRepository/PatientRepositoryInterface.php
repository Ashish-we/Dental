<?php

namespace App\Repositories\PatientRepository;

interface PatientRepositoryInterface
{

    public function all();

    public function find($id);

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);
}
