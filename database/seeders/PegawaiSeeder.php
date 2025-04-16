<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pegawai;  
use Faker\Factory as Faker;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Lokal Indonesia

        for ($i = 0; $i < 50; $i++) { // 🔥 50 Data Dummy
            Pegawai::create([
                'nama' => $faker->name,
                'jabatan' => $faker->jobTitle,
                'alamat' => $faker->address,
            ]);
    }
}
}
