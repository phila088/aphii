<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentTermSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('payment_terms')->insert([
            ['user_id' => 1, 'code' => 'NET15X', 'title' => 'NET15', 'net_days' => 15, 'amount_cod' => 0, 'percent_cod' => 0, 'amount_net' => 0, 'percent_net' => 1, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'code' => 'N1525P', 'title' => 'NET15, 25% down', 'net_days' => 15, 'amount_cod' => 0, 'percent_cod' => 0.25, 'amount_net' => 0, 'percent_net' => 0.75, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'code' => 'N1550P', 'title' => 'NET15, 50% down', 'net_days' => 15, 'amount_cod' => 0, 'percent_cod' => 0.50, 'amount_net' => 0, 'percent_net' => 0.50, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'code' => 'N1575P', 'title' => 'NET15, 75% down', 'net_days' => 15, 'amount_cod' => 0, 'percent_cod' => 0.75, 'amount_net' => 0, 'percent_net' => 0.25, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'code' => 'NET20X', 'title' => 'NET20', 'net_days' => 20, 'amount_cod' => 0, 'percent_cod' => 0, 'amount_net' => 0, 'percent_net' => 1, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'code' => 'N2025P', 'title' => 'NET20, 25% down', 'net_days' => 20, 'amount_cod' => 0, 'percent_cod' => 0.25, 'amount_net' => 0, 'percent_net' => 0.75, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'code' => 'N2050P', 'title' => 'NET20, 50% down', 'net_days' => 20, 'amount_cod' => 0, 'percent_cod' => 0.50, 'amount_net' => 0, 'percent_net' => 0.50, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'code' => 'N2075P', 'title' => 'NET20, 75% down', 'net_days' => 20, 'amount_cod' => 0, 'percent_cod' => 0.75, 'amount_net' => 0, 'percent_net' => 0.25, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'code' => 'NET25X', 'title' => 'NET25', 'net_days' => 25, 'amount_cod' => 0, 'percent_cod' => 0, 'amount_net' => 0, 'percent_net' => 1, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'code' => 'N2525P', 'title' => 'NET25, 25% down', 'net_days' => 25, 'amount_cod' => 0, 'percent_cod' => 0.25, 'amount_net' => 0, 'percent_net' => 0.75, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'code' => 'N2550P', 'title' => 'NET25, 50% down', 'net_days' => 25, 'amount_cod' => 0, 'percent_cod' => 0.50, 'amount_net' => 0, 'percent_net' => 0.50, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'code' => 'N2575P', 'title' => 'NET25, 75% down', 'net_days' => 25, 'amount_cod' => 0, 'percent_cod' => 0.75, 'amount_net' => 0, 'percent_net' => 0.25, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'code' => 'NET30X', 'title' => 'NET30', 'net_days' => 30, 'amount_cod' => 0, 'percent_cod' => 0, 'amount_net' => 0, 'percent_net' => 1, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'code' => 'N3025P', 'title' => 'NET30, 25% down', 'net_days' => 30, 'amount_cod' => 0, 'percent_cod' => 0.25, 'amount_net' => 0, 'percent_net' => 0.75, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'code' => 'N3050P', 'title' => 'NET30, 50% down', 'net_days' => 30, 'amount_cod' => 0, 'percent_cod' => 0.50, 'amount_net' => 0, 'percent_net' => 0.50, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'code' => 'N3075P', 'title' => 'NET30, 75% down', 'net_days' => 30, 'amount_cod' => 0, 'percent_cod' => 0.75, 'amount_net' => 0, 'percent_net' => 0.25, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'code' => 'NET45X', 'title' => 'NET45', 'net_days' => 45, 'amount_cod' => 0, 'percent_cod' => 0, 'amount_net' => 0, 'percent_net' => 1, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'code' => 'N4525P', 'title' => 'NET45, 25% down', 'net_days' => 45, 'amount_cod' => 0, 'percent_cod' => 0.25, 'amount_net' => 0, 'percent_net' => 0.75, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'code' => 'N4550P', 'title' => 'NET45, 50% down', 'net_days' => 45, 'amount_cod' => 0, 'percent_cod' => 0.50, 'amount_net' => 0, 'percent_net' => 0.50, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'code' => 'N4575P', 'title' => 'NET45, 75% down', 'net_days' => 45, 'amount_cod' => 0, 'percent_cod' => 0.75, 'amount_net' => 0, 'percent_net' => 0.25, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'code' => 'NET60X', 'title' => 'NET60', 'net_days' => 60, 'amount_cod' => 0, 'percent_cod' => 0, 'amount_net' => 0, 'percent_net' => 1, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'code' => 'N6025P', 'title' => 'NET60, 25% down', 'net_days' => 60, 'amount_cod' => 0, 'percent_cod' => 0.25, 'amount_net' => 0, 'percent_net' => 0.75, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'code' => 'N6050P', 'title' => 'NET60, 50% down', 'net_days' => 60, 'amount_cod' => 0, 'percent_cod' => 0.50, 'amount_net' => 0, 'percent_net' => 0.50, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'code' => 'N6075P', 'title' => 'NET60, 75% down', 'net_days' => 60, 'amount_cod' => 0, 'percent_cod' => 0.75, 'amount_net' => 0, 'percent_net' => 0.25, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'code' => 'NET90X', 'title' => 'NET90', 'net_days' => 90, 'amount_cod' => 0, 'percent_cod' => 0, 'amount_net' => 0, 'percent_net' => 1, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'code' => 'N9025P', 'title' => 'NET90, 25% down', 'net_days' => 90, 'amount_cod' => 0, 'percent_cod' => 0.25, 'amount_net' => 0, 'percent_net' => 0.75, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'code' => 'N9050P', 'title' => 'NET90, 50% down', 'net_days' => 90, 'amount_cod' => 0, 'percent_cod' => 0.50, 'amount_net' => 0, 'percent_net' => 0.50, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'code' => 'N9075P', 'title' => 'NET90, 75% down', 'net_days' => 90, 'amount_cod' => 0, 'percent_cod' => 0.75, 'amount_net' => 0, 'percent_net' => 0.25, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'code' => 'CODXXX', 'title' => 'COD', 'net_days' => 0, 'amount_cod' => 0, 'percent_cod' => 1, 'amount_net' => 0, 'percent_net' => 0, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
