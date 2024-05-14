<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PremissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission = Permission::create(['name' => 'appointments']);
        $permission = Permission::create(['name' => 'appointments.add']);
        $permission = Permission::create(['name' => 'appointments.edit']);
        $permission = Permission::create(['name' => 'appointments.delete']);

        $permission = Permission::create(['name' => 'patients']);
        $permission = Permission::create(['name' => 'patients.add']);
        $permission = Permission::create(['name' => 'patients.edit']);
        $permission = Permission::create(['name' => 'patients.delete']);

        $permission = Permission::create(['name' => 'dentists']);
        $permission = Permission::create(['name' => 'dentists.add']);
        $permission = Permission::create(['name' => 'dentists.edit']);
        $permission = Permission::create(['name' => 'dentists.delete']);
 

        $permission = Permission::create(['name' => 'procedures']);
        $permission = Permission::create(['name' => 'procedures.add']);
        $permission = Permission::create(['name' => 'procedures.edit']);
        $permission = Permission::create(['name' => 'procedures.delete']);


        $permission = Permission::create(['name' => 'staffs']);
        $permission = Permission::create(['name' => 'staffs.add']);
        $permission = Permission::create(['name' => 'staffs.edit']);
        $permission = Permission::create(['name' => 'staffs.delete']);
 

        $permission = Permission::create(['name' => 'services']);
        $permission = Permission::create(['name' => 'services.add']);
        $permission = Permission::create(['name' => 'services.edit']);
        $permission = Permission::create(['name' => 'services.delete']);


        $permission = Permission::create(['name' => 'medicalrecords']);
        $permission = Permission::create(['name' => 'medicalrecords.add']);
        $permission = Permission::create(['name' => 'medicalrecords.edit']);
        $permission = Permission::create(['name' => 'medicalrecords.delete']);


        $permission = Permission::create(['name' => 'followups']);
        $permission = Permission::create(['name' => 'followups.add']);
        $permission = Permission::create(['name' => 'followups.edit']);
        $permission = Permission::create(['name' => 'followups.delete']);

        $permission = Permission::create(['name' => 'account-setting']);

                $permission = Permission::create(['name' => 'servicecategories']);
        $permission = Permission::create(['name' => 'servicecategories.add']);
        $permission = Permission::create(['name' => 'servicecategories.edit']);
        $permission = Permission::create(['name' => 'servicecategories.delete']);

        $role = Role::findbyName('dentist');
        $role->syncPermissions([
            'appointments',
            'appointments.edit',
            'patients',
            // 'patients.edit',
            'medicalrecords',
            'followups',
            'account-setting'
        ]);

        $role = Role::findbyName('receptionist');
        $role->syncPermissions([
            'account-setting',
            'services',

            'procedures',
            'procedures.add',
            'procedures.edit',
            'procedures.delete',

            'appointments',
            'appointments.add',
            'appointments.edit',
            'appointments.delete',

            'patients',
            'patients.add',
            'patients.edit',
            'patients.delete',

            'medicalrecords',
            'medicalrecords.add',
            'medicalrecords.edit',
            'medicalrecords.delete',

            'followups',
            'followups.add',
            'followups.edit',
            'followups.delete',

        ]);
        $role = Role::findbyName('admin');
        // $role->revokePermissionTo([
        //     'patients',
        //     'patients.add',
        //     'patients.edit',
        //     'patients.delete',
        // ]);
            $role->syncPermissions([    //Permission::all()
                // 'dentists',
                'dentists',
                'dentists.add',
                'dentists.edit',
                'dentists.delete',
                // 'appointments.all',
                'appointments',
                'appointments.add',
                'appointments.edit',
                'appointments.delete',
                // 'services.all',
                'services',
                'services.add',
                'services.edit',
                'services.delete',
                // 'staffs.all',
                'staffs',
                'staffs.add',
                'staffs.edit',
                'staffs.delete',
                // 'patients.all',
                'patients',
                'patients.add',
                'patients.edit',
                'patients.delete',

                'servicecategories',
                'servicecategories.add',
                'servicecategories.edit',
                'servicecategories.delete',

            ]);
    }
}
