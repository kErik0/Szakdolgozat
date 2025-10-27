<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Company;

class JobsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('hu_HU');
        $companies = DB::table('companies')->pluck('id')->toArray();
        $types = ['Teljes munkaidő', 'Rész munkaidő', 'Gyakornok', 'Hibrid'];

        for ($i = 0; $i < 50; $i++) {
            DB::table('jobs')->insert([
                'company_id' => $companies[array_rand($companies)],
                'title' => $faker->jobTitle,
                'description' => $faker->paragraph,
                'location' => $faker->city,
                'salary' => $faker->numberBetween(0, 1000000),
                'type' => $types[array_rand($types)],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
