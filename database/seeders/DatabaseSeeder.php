<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'superadmin@gmail.com',
            ],
            [
                'name' => 'Super Admin',
                'user_role' => 4,
                'farm_id' => null,
                'str_password' => 'password',
                'password' => Hash::make('password'),
            ]
        );
    }
}