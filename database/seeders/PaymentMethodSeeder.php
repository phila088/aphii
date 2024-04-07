<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('payment_methods')->insert([
            ['name' => 'PayPal', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Zelle', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Credit Card', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Check', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'eCheck', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'EFT', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cash', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cash App', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
