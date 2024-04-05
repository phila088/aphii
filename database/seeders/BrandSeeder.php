<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('brands')->insert([
            ['id' => 1, 'user_id' => 1, 'name' => 'Bloomin Acres, LLC', 'dba' => 'Bloom Works', 'abbreviation' => 'BWRKS', 'internal_work_order_prefix' => 'BW-', 'internal_work_order_max_length' => 6, 'logo_path' => 'storage/brand-logos/6ZxH8Mdnx5dhnLLe7zyWCm8J8YiOXzVcIAwBp9XV.png', 'fein' => '', 'state_license_number' => '', 'county_license_number' => '', 'city_license_number' => '', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'user_id' => 1, 'name' => 'MIH Maintenance, LLC', 'dba' => 'Make It Happen Maintenance', 'abbreviation' => 'MIHM', 'internal_work_order_prefix' => 'MM-', 'internal_work_order_max_length' => 6, 'logo_path' => 'storage/brand-logos/1IJuQdGMI8Oyw6SHuxQq8eCBKZ0j1c9d3ZF4kexD.png', 'fein' => '', 'state_license_number' => '', 'county_license_number' => '', 'city_license_number' => '', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'user_id' => 1, 'name' => 'Superior Trades and Tailored Services, LLC', 'dba' => '', 'abbreviation' => 'STATS', 'internal_work_order_prefix' => 'ST-', 'internal_work_order_max_length' => 6, 'logo_path' => 'storage/brand-logos/8oIgJWCMxW3aLjmDeualPDb4nNHwU4U3UNTPUVCd.png', 'fein' => '', 'state_license_number' => '', 'county_license_number' => '', 'city_license_number' => '', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
