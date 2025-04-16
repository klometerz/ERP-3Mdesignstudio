<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pelanggan; // <<< 🔥 HARUS ADA INI
use Faker\Factory as Faker;

class PelangganSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 20; $i++) {
            Pelanggan::create([
                'kode_pelanggan' => 'PEL' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'nama' => $faker->name,
                'alamat' => $faker->address,
                'kota' => $faker->city,
                'provinsi' => $faker->state,
                'zipcode' => $faker->postcode,
                'negara' => $faker->country,
                'kode_negara' => strtoupper($faker->countryCode),
                'email' => $faker->email,
                'telepon' => $faker->phoneNumber,
                'status_pelanggan' => $faker->randomElement(['Aktif', 'Tidak Aktif']),
                'is_dummy' => true,
            ]);
        }
    }
}
