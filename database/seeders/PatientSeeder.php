<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {
            Patient::create([
                'name' => fake()->name(),
                'address' => fake()->address(),
                'telephone_number' => fake()->phoneNumber(),
                'id_hospital' => rand(1, 10),
            ]);
        }
    }
}
