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
            ['for_model' => 'Brand', 'code' => 'MRKDEL', 'title' => 'Brand deleted', 'default_reason' => 'Marked for deletion'],
            ['for_model' => 'Call', 'code' => 'CALCMP', 'title' => 'Call complete', 'default_reason' => 'Call completed, closing'],
            ['for_model' => 'Call', 'code' => 'LOOPED', 'title' => 'Call looped', 'default_reason' => 'Call needs to be looped, followup required'],
            ['for_model' => 'Call', 'code' => 'MRKDEL', 'title' => 'Call deleted', 'default_reason' => 'Mark for deletion'],
            ['for_model' => 'Certifications', 'code' => 'MRKDEL', 'title' => 'Certification deleted', 'default_reason' => 'Marked for deletion'],
            ['for_model' => 'City', 'code' => 'FIXZIP', 'title' => 'Fix zip', 'default_reason' => 'The zip code is incorrectly formatted, please fix'],
            ['for_model' => 'City', 'code' => 'MRKDEL', 'title' => 'City deleted', 'default_reason' => 'Marked for deletion'],
            ['for_model' => 'Client', 'code' => 'Active', 'title' => 'Client is active', 'default_reason' => 'Client activated'],
            ['for_model' => 'Client', 'code' => 'DNU', 'title' => 'Do not use', 'default_reason' => 'Client cannot be used'],
            // ['for_model' => '', 'code' => '', 'title' => '', 'default_reason' => ''],
        ]);
    }
}
