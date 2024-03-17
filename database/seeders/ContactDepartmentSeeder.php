<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactDepartmentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('contact_departments')->insert([
            ['title' => 'Accounting'],
            ['title' => 'Accounts Payables'],
            ['title' => 'Accounts Receivables'],
            ['title' => 'IT'],
            ['title' => 'Procurement'],
            ['title' => 'Projects'],
            ['title' => 'Quoting'],
            ['title' => 'Sales'],
        ]);
    }
}
