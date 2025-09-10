<?php

namespace Database\Seeders;

use App\Models\Hospital;
use Illuminate\Database\Seeder;

class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hospital::create([
            'name' => 'RS Harapan Sehat',
            'address' => 'Jl. Merdeka No. 1, Jakarta',
            'email' => 'info@harapansehat.com',
            'telephone' => '0211234567'
        ]);

        Hospital::create([
            'name' => 'RS Citra Medika',
            'address' => 'Jl. Sudirman No. 20, Jakarta',
            'email' => 'info@citramedika.com',
            'telephone' => '0217654321'
        ]);

        Hospital::create([
            'name' => 'RS Cipto Mangunkusumo',
            'address' => 'Jl. Diponegoro No. 71, Jakarta',
            'email' => 'info@rscm.co.id',
            'telephone' => '0211500135'
        ]);

        Hospital::create([
            'name' => 'RS Dr. Sardjito',
            'address' => 'Jl. Kesehatan No. 1, Sleman, Yogyakarta',
            'email' => 'info@sardjito.co.id',
            'telephone' => '0274584500'
        ]);

        Hospital::create([
            'name' => 'RSUP Dr. Kariadi',
            'address' => 'Jl. Dr. Sutomo No. 16, Semarang',
            'email' => 'info@kariadi.co.id',
            'telephone' => '0248413476'
        ]);

        Hospital::create([
            'name' => 'RS Dr. Soetomo',
            'address' => 'Jl. Mayjen Prof. Dr. Moestopo No. 6-8, Surabaya',
            'email' => 'info@soetomo.co.id',
            'telephone' => '0315501078'
        ]);

        Hospital::create([
            'name' => 'RSUP Sanglah',
            'address' => 'Jl. Diponegoro, Denpasar, Bali',
            'email' => 'info@sanglahhospital.co.id',
            'telephone' => '0361227081'
        ]);

        Hospital::create([
            'name' => 'RS Hasan Sadikin',
            'address' => 'Jl. Pasteur No. 38, Bandung',
            'email' => 'info@rshs.co.id',
            'telephone' => '0222034953'
        ]);

        Hospital::create([
            'name' => 'RSUP Wahidin Sudirohusodo',
            'address' => 'Jl. Perintis Kemerdekaan Km. 11, Makassar',
            'email' => 'info@wahidin.co.id',
            'telephone' => '0411455090'
        ]);

        Hospital::create([
            'name' => 'RS Adam Malik',
            'address' => 'Jl. Bunga Lau No. 17, Medan',
            'email' => 'info@adammalik.co.id',
            'telephone' => '0618360381'
        ]);
    }
}
