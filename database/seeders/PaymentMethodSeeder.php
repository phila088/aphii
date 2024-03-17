<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('payment_methods')->insert([
            ['title' => 'Android Pay'],
            ['title' => 'Apple Cash'],
            ['title' => 'Apple Pay'],
            ['title' => 'Cash'],
            ['title' => 'CashApp'],
            ['title' => 'Check'],
            ['title' => 'Credit Card'],
            ['title' => 'Debit Card'],
            ['title' => 'EFT'],
            ['title' => 'Other'],
            ['title' => 'PayPal'],
            ['title' => 'Zelle'],
        ]);
    }
}
