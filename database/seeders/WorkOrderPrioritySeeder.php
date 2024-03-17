<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkOrderPrioritySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('work_order_priorities')->insert([
            ['code' => 'EMR004', 'title' => 'Emergency, complete within 4 hours', 'hours_to_onsite' => 0, 'hours_to_quote' => 0, 'hours_to_complete' => 4, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'EMR400', 'title' => 'Emergency, on-site within 4 hours', 'hours_to_onsite' => 4, 'hours_to_quote' => 0, 'hours_to_complete' => 0, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'EMR440', 'title' => 'Emergency, on-site and quoted within 4 hours', 'hours_to_onsite' => 4, 'hours_to_quote' => 4, 'hours_to_complete' => 0, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'EMR404', 'title' => 'Emergency, on-site and completed within 4 hours', 'hours_to_onsite' => 4, 'hours_to_quote' => 0, 'hours_to_complete' => 4, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'EMR408', 'title' => 'Emergency, on-site and completed within 8 hours', 'hours_to_onsite' => 4, 'hours_to_quote' => 0, 'hours_to_complete' => 8, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'EMR480', 'title' => 'Emergency, on-site and quoted within 8 hours', 'hours_to_onsite' => 4, 'hours_to_quote' => 8, 'hours_to_complete' => 0, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'IMD008', 'title' => 'Immediate, completed within 8 hours', 'hours_to_onsite' => 0, 'hours_to_quote' => 0, 'hours_to_complete' => 8, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'IMD080', 'title' => 'Immediate, quoted within 8 hours', 'hours_to_onsite' => 0, 'hours_to_quote' => 8, 'hours_to_complete' => 0, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'IMD800', 'title' => 'Immediate, on-site within 8 hours', 'hours_to_onsite' => 8, 'hours_to_quote' => 0, 'hours_to_complete' => 0, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'SD0012', 'title' => 'Same day, completed within 12 hours', 'hours_to_onsite' => 0, 'hours_to_quote' => 0, 'hours_to_complete' => 12, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'SD0120', 'title' => 'Same day, quoted within 12 hours', 'hours_to_onsite' => 0, 'hours_to_quote' => 12, 'hours_to_complete' => 0, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'SD1200', 'title' => 'Same day, on-site within 12 hours', 'hours_to_onsite' => 12, 'hours_to_quote' => 0, 'hours_to_complete' => 0, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'STD024', 'title' => 'Standard, on-site within 1 day', 'hours_to_onsite' => 24, 'hours_to_quote' => 24, 'hours_to_complete' => 0, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'STD048', 'title' => 'Standard, on-site within 2 days', 'hours_to_onsite' => 48, 'hours_to_quote' => 24, 'hours_to_complete' => 0, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'STD072', 'title' => 'Standard, on-site within 3 days', 'hours_to_onsite' => 72, 'hours_to_quote' => 24, 'hours_to_complete' => 0, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'STD096', 'title' => 'Standard, on-site within 4 days', 'hours_to_onsite' => 96, 'hours_to_quote' => 24, 'hours_to_complete' => 0, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'STD120', 'title' => 'Standard, on-site within 5 days', 'hours_to_onsite' => 120, 'hours_to_quote' => 24, 'hours_to_complete' => 0, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'STD144', 'title' => 'Standard, on-site within 6 days', 'hours_to_onsite' => 144, 'hours_to_quote' => 24, 'hours_to_complete' => 0, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'STD168', 'title' => 'Standard, on-site within 7 days', 'hours_to_onsite' => 168, 'hours_to_quote' => 24, 'hours_to_complete' => 0, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'MNT168', 'title' => 'Maintenance, on-site within 7 days', 'hours_to_onsite' => 168, 'hours_to_quote' => 24, 'hours_to_complete' => 0, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'RFQ168', 'title' => 'Request for quote, on-site within 7 days', 'hours_to_onsite' => 168, 'hours_to_quote' => 24, 'hours_to_complete' => 0, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],

        ]);
    }
}
