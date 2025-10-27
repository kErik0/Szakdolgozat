<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('hu_HU');

        for ($i = 0; $i < 50; $i++) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'profile_picture' => null,
                'resume' => null,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'role' => 'user'
            ]);
        }
    }
}