<?php

namespace Database\Seeders;

use App\Models\TeethType;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {



        $types = ["Central Incisor", "Lateral Incisor", "Canine", "First Premolar", "Second Premolar", "First Molar", "Second Molar", "Third Molar", "Wisdom Teeth"];

        foreach ($types as $type) {

            TeethType::create([


                'name' => $type,


            ]);

        }



    }
}
