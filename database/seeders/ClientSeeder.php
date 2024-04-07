<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('clients')->insert([
            [
                'id' => 1,
                'user_id' => 2,
                'name' => 'RSM Maintenance, LLC.',
                'abbreviation' => 'RSM',
                'onboarding_started' => true,
                'onboarding_started_date' => '2023-11-17',
                'onboarding_finished' => true,
                'onboarding_finished_date' => '2024-02-14',
            ]
        ]);
    }
}
