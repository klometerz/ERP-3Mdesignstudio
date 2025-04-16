<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pelanggan;
use App\Models\User;
use App\Models\Role;

class GenerateUserFromPelangganSeeder extends Seeder
{
    public function run(): void
    {
        $rolePelanggan = Role::where('name', 'pelanggan')->first();

        if (!$rolePelanggan) {
            $this->command->error('Role pelanggan tidak ditemukan. Seeder dibatalkan.');
            return;
        }

        $pelanggans = Pelanggan::all();

        foreach ($pelanggans as $pelanggan) {
            // Cek kalau sudah ada user dengan email pelanggan
            $existingUser = User::where('email', $pelanggan->email)->first();
            if ($existingUser) {
                continue; // Skip kalau sudah ada user
            }

            User::create([
                'name' => $pelanggan->nama,
                'email' => $pelanggan->email,
                'password' => bcrypt('password'), // Password default
                'role_id' => $rolePelanggan->id,
            ]);
        }

        $this->command->info('Semua user pelanggan berhasil dibuat!');
    }
}
