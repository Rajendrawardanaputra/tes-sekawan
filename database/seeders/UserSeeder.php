<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'testing',
            'email' => 'testing1@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'approver'
        ]);

        User::create([
            'name' => 'testing',
            'email' => 'testing2@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'approver'
        ]);
    }
}
