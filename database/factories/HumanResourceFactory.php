<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HumanResource>
 */
class HumanResourceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_sdm' => $this->faker->uuid(),
            'nama_sdm' => $this->faker->name(),
            'nidn' => $this->faker->regexify('[0-9]{9}'),
            'nip' => $this->faker->regexify('[0-9]{18}'),
            'nama_status_aktif' => 'Aktif',
            'nama_status_pegawai' => 'PNS',
            'jenis_sdm' => 'Dosen',
        ];
    }
}
