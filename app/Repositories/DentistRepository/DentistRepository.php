<?php

namespace App\Repositories\DentistRepository;

use App\Models\Dentist;
use App\Models\User;
use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Models\Role as ModelsRole;

class DentistRepository implements DentistRepositoryInterface
{
    public function all()
    {
        return User::role('dentist');
    }

    public function find($id)
    {
        return Dentist::findOrFail($id);
    }

    public function create(array $data)
    {

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt('skysoft'),
            'address' => $data['address'],
            'mobile' => $data['mobile'],
            'alternative_mobile' => $data['alternative_mobile'],
            'dob' => $data['dob'],
            'alternative_email' => $data['alternative_email'],
            'gender' => $data['gender'],
        ]);
        $user->assignRole('dentist');
        return Dentist::create([
            'type_id' => $data['type_id'],
            'user_id' => $user->id,
            'qualification' => $data['qualification'],
            'speciality' => $data['speciality']
        ]);
    }

    public function update(array $data, $id, $user_id)
    {

        $user = User::findOrFail($user_id);
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt('skysoft'),
            'address' => $data['address'],
            'mobile' => $data['mobile'],
            'alternative_mobile' => $data['alternative_mobile'],
            'dob' => $data['dob'],
            'alternative_email' => $data['alternative_email'],
            'gender' => $data['gender'],
        ]);

        $dentist = Dentist::findOrFail($id);
        $dentist->update([
            'type_id' => $data['type_id'],
            'user_id' => $user->id,
            'qualification' => $data['qualification'],
            'speciality' => $data['speciality']
        ]);

        return $dentist;
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return True;
    }
}
