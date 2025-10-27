<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class CompaniesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('hu_HU');

        for ($i = 0; $i < 50; $i++) {
            DB::table('companies')->insert([
                'name' => $faker->company,
                'email' => $faker->unique()->companyEmail,
                'email_verified_at' => $i % 4 == 0 ? null : now(), // minden 4. nincs verified
                'password' => bcrypt('password'),
                'description' => $faker->text(255),
                'created_at' => now(),
                'updated_at' => now(),
                'role' => 'company',
                'logo' => null,
                'remember_token' => Str::random(10)
            ]);
        }
    }
}