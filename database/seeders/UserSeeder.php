<?php

namespace Database\Seeders;

use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users = [
            [
                'username' => 'admin',
                'full_name' => 'admin',
                'email' => 'admin@admin.com',
                'type' => 'admin',
                'photo' => null,
                'phone' => '123456789',
                'gender' => 'male',
                'status' => 'active',
                'password' => Hash::make('password'), // Hash password for security
                'id_number' => null,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more users as needed
        ];

        // Insert data into the database
        foreach ($users as $user) {
            $user = User::firstOrCreate(
                ['username' => $user['username']],
                $user
            );
        }
    }
}
