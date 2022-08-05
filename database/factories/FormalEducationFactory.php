<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FormalEducation>
 */
class FormalEducationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_sdm' => "45bbad5c-b80e-3351-bc18-38e7623aa195",
            'id_pendidikan' => $this->faker->uuid(),
            'jenjang_pendidikan' => "S3",
            'gelar_akademik' => "Doktor",
            'bidang_studi' => "Teknik Informatika",
            'nama_perguruan_tinggi' => $this->faker->company(),
            'tahun_lulus' => $this->faker->year(),
        ];
    }
}
