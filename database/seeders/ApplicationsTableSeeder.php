<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ApplicationsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('hu_HU');
        $statuses = ['accepted','rejected','archived','deleted'];
        $users = DB::table('users')->pluck('id');
        $jobs = DB::table('jobs')->pluck('id');

        foreach ($users as $user_id) {
            $appliedJobs = $jobs->random(rand(1,3));
            $appliedJobs = is_array($appliedJobs) || $appliedJobs instanceof \Illuminate\Support\Collection ? $appliedJobs : [$appliedJobs];

            foreach ($appliedJobs as $job_id) {
                DB::table('applications')->insert([
                    'user_id' => $user_id,
                    'job_id' => $job_id,
                    'status' => (string) $statuses[array_rand($statuses)],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }
}
