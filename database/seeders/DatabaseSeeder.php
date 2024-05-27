<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        
        DB::table('users')->insert([
            [
                'name' => 'rai admin',
                'email' => 'raiadmin@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
                'status' => 1,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'rai seller',
                'email' => 'raiseller@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'seller',   
                'status' => 1,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'rai user',
                'email' => 'raiuser@gmail.com',
                'password' => Hash::make('12345678'),        
                'role' => 'user',       
                'status' => 1,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

      
    }
}
