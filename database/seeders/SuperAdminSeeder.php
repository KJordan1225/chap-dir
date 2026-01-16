<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@chapter.test'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('Password123!'),
                'is_superadmin' => true,
            ]
        );
    }
}