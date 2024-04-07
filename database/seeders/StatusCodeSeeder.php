<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusCodeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('status_codes')->insert([
            ['for_model' => 'Brand', 'code' => 'ONBRDG', 'title' => 'Brand onboarding', 'default_reason' => 'Brand paperwork is in the works, not completed'],
            ['for_model' => 'Brand', 'code' => 'ACTIVE', 'title' => 'Brand active', 'default_reason' => 'Brand is active, and ready'],
            ['for_model' => 'Brand', 'code' => 'INACTV', 'title' => 'Brand inactive', 'default_reason' => 'Brand inactive'],
            ['for_model' => 'City', 'code' => 'FIXZIP', 'title' => 'Fix zip', 'default_reason' => 'The zip code is incorrectly formatted, please fix'],
            ['for_model' => 'Client', 'code' => 'ONBRDG', 'title' => 'Client onboarding', 'default_reason' => 'Client onboarding'],
            ['for_model' => 'Client', 'code' => 'ACTIVE', 'title' => 'Client active', 'default_reason' => 'Client activated'],
            ['for_model' => 'Client', 'code' => 'DNUXXX', 'title' => 'Do not use', 'default_reason' => 'Client cannot be used'],
            ['for_model' => 'Vendor', 'code' => 'ACTIVE', 'title' => 'Vendor active', 'default_reason' => 'Vendor active'],
            ['for_model' => 'Vendor', 'code' => 'DNUXXX', 'title' => 'Vendor DNU', 'default_reason' => 'Vendor DNU'],
            // ['for_model' => '', 'code' => '', 'title' => '', 'default_reason' => ''],
        ]);
    }
}
