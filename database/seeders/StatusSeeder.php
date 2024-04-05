<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('statuses')->insert([
            ['id' => 1, 'name' => 'BRDACT', 'reason' => 'Brand active, carryover data from old systems', 'model_type' => 'App\Models\Brand', 'model_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'BRDACT', 'reason' => 'Brand active, carryover data from old systems', 'model_type' => 'App\Models\Brand', 'model_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'BRDACT', 'reason' => 'Brand active, carryover data from old systems', 'model_type' => 'App\Models\Brand', 'model_id' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
