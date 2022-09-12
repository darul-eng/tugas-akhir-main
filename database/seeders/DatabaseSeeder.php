<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // \App\Models\HumanResource::factory(10)->create();
        \App\Models\FormalEducation::factory(3)->create([
            'id_sdm' => "30c8e744-5210-3e83-8905-23aab26d25e3",
        ]);
        \App\Models\FormalEducation::factory(3)->create([
            'id_sdm' => "40ff0339-3143-3e72-b8b4-ec3d7c9c7e3a",
        ]);
        \App\Models\FormalEducation::factory(3)->create([
            'id_sdm' => "baa442a8-72a9-3331-9daf-c8b7beedec78",
        ]);
        \App\Models\FormalEducation::factory(3)->create([
            'id_sdm' => "a89252fe-59ca-3499-a3ab-594ab7e22b18",
        ]);
        \App\Models\FormalEducation::factory(3)->create([
            'id_sdm' => "584038eb-bc06-3cd3-a681-605ede03deb8",
        ]);
        \App\Models\FormalEducation::factory(3)->create([
            'id_sdm' => "865f1b10-e907-3386-b1f3-7d9126cc35b9",
        ]);
        \App\Models\FormalEducation::factory(3)->create([
            'id_sdm' => "9881602d-fb9f-3ac5-98cc-7f39076d465e",
        ]);
        \App\Models\FormalEducation::factory(3)->create([
            'id_sdm' => "fc8becbf-ef9d-3152-b07e-6f4d18e687ee",
        ]);
        \App\Models\FormalEducation::factory(3)->create([
            'id_sdm' => "f74b73c3-2a4e-389c-914a-e132655e483b",
        ]);
        \App\Models\FormalEducation::factory(3)->create([
            'id_sdm' => "1e345d09-a23f-35be-a8af-ccf637553b19",
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Tester',
            'email' => 'test@gmail.com',
        ]);
    }
}
