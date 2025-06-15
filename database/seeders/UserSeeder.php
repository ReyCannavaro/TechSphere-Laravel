<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    public function run(): void
    {

        User::create([
            'name' => 'Admin TechSphere',
            'email' => 'admin@techsphere.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'User TechSphere',
            'email' => 'user@techsphere.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Larissa Paulina',
            'email' => 'larissa@techsphere.com',
            'password' => Hash::make('larissap'),
            'email_verified_at' => now(),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Rey',
            'email' => 'reyjunoalcannavaro@gmail.com',
            'password' => Hash::make('Cosmos2207'),
            'email_verified_at' => now(),
            'role' => 'user',
        ]);
    }
}