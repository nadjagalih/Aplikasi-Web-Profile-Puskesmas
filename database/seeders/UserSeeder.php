<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@puskesmas.com',
            'password' => Hash::make('password'),
            'foto' => null,
        ]);

        User::create([
            'name' => 'Staff Puskesmas',
            'username' => 'staff',
            'email' => 'staff@puskesmas.com',
            'password' => Hash::make('password'),
            'foto' => null,
        ]);
    }
}
