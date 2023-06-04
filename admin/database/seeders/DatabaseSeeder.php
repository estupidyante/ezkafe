<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*  insert admin  */
        User::create([ 
            'name' => 'admin',
            'email' => 'admin@ezkafe.com',
            'userType' => 'ADM', // USR - ADM
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'current_team_id' => 0,
            'profile_photo_path' => '',
            'role' => 0,
        ]);

        /* insert user */
        User::create([ 
            'name' => 'user',
            'email' => 'user@ezkafe.com',
            'userType' => 'USR', // USR - ADM
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'current_team_id' => 0,
            'profile_photo_path' => '',
            'role' => 1,
        ]);
    }
}
