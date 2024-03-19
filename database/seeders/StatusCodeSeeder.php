<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusCodeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('status_codes')->insert([
            ['for_model' => 'Brand', 'code' => 'BRDCON', 'title' => 'Brand concept', 'default_reason' => 'Brand concept only, not valid'],
            ['for_model' => 'Brand', 'code' => 'BRDONB', 'title' => 'Brand onboarding', 'default_reason' => 'Brand paperwork is in the works, not completed'],
            ['for_model' => 'Brand', 'code' => 'BRDACT', 'title' => 'Brand active', 'default_reason' => 'Brand is active, and ready'],
            ['for_model' => 'Brand', 'code' => 'BRDIAC', 'title' => 'Brand inactive', 'default_reason' => 'Brand inactive'],
            ['for_model' => 'Brand', 'code' => 'BRDCLS', 'title' => 'Brand closed', 'default_reason' => 'Brand closed'],
            ['for_model' => 'Brand', 'code' => 'BRDDEL', 'title' => 'Brand deleted', 'default_reason' => 'Brand deleted'],
            // ['for_model' => '', 'code' => '', 'title' => '', 'default_reason' => ''],
        ]);
    }
}
