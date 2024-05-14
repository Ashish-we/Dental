<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create(['name' => 'dentist']);
        $role = Role::create(['name' => 'receptionist']);
        $role = Role::create(['name' => 'admin']);
        // $role=Role::create(['name'=>'patient']);

    }
}
