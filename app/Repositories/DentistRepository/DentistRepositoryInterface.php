<?php

namespace App\Repositories\DentistRepository;

interface DentistRepositoryInterface
{

    public function all();

    public function find($id);

    public function create(array $data);

    public function update(array $data, $id, $user_id);

    public function delete($id);
}
