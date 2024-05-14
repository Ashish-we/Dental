<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\DentistSeeder;
use Database\Seeders\PatientSeeder;
use Database\Seeders\PremissionSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\TypeSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(RoleSeeder::class);
        $this->call(PremissionSeeder::class);
        // $this->call(PatientSeeder::class);
        // $this->call(DentistSeeder::class);
        $this->call(StaffSeeder::class);
        // $this->call(ServiceSeeder::class);
        // $this->call(TypeSeeder::class);
    }
}
