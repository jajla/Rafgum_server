<?php

namespace Database\Seeders;

use App\Enums\Roles;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'kamil',
            'last_name' => 'michalski',
            'phone_number' => '723071027',
            'email' => 'kamilmichalski09@gmail.com',
            'email_verified_at' => now(),
            'role' => Roles::Admin,
            'password' => Hash::make('1234'),
            //'remember_token' => Str::random(10),
        ]);

        // Możesz tutaj też dodać usera testowego
        User::create([
            'name' => 'user',
            'last_name' => 'testowy',
            'phone_number' => '123456789',
            'email' => 'test1@gmail.com',
            'email_verified_at' => now(),
            'role' => Roles::User,
            'password' => Hash::make('1234'),
           // 'remember_token' => Str::random(10),
        ]);
    }
}


