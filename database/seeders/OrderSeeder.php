<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Pelanggan;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        foreach (Pelanggan::where('is_dummy', true)->get() as $pelanggan) {
            for ($i = 0; $i < rand(3, 5); $i++) {
                Order::create([
                    'pelanggan_id' => $pelanggan->id,
                    'tanggal_order' => $faker->date(),
                    'tanggal_selesai_order' => $faker->date(),
                    'nilai_order' => $faker->numberBetween(1000000, 50000000),
                    'status_order' => $faker->randomElement(['Proses', 'Selesai', 'Batal']),
                ]);
            }
        }
    }
}
