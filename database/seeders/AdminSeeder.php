<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();

        if (!$adminRole) {
            $this->command->error('Role admin tidak ditemukan. Seeder dibatalkan.');
            return;
        }

        // Cek apakah admin sudah ada
        $existingAdmin = User::where('email', 'admin@example.com')->first();
        if (!$existingAdmin) {
            User::create([
                'name' => 'Super Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'), // Default password: password
                'role_id' => $adminRole->id,
            ]);

            $this->command->info('Admin account berhasil dibuat!');
        } else {
            $this->command->info('Admin account sudah ada, skip create.');
        }
    }
}
