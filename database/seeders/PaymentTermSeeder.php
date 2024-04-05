<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentTermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payment_terms')->insert([
            ['user_id' => 1, 'name' => 'COD Only', 'code' => 'CODXXX', 'net_days' => '0', 'net_amount' => '0', 'net_percent' => '0', 'cod_amount' => '0', 'cod_percent' => '100', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'COD 25%, NET10', 'code' => 'C25N10', 'net_days' => '10', 'net_amount' => '0', 'net_percent' => '75', 'cod_amount' => '0', 'cod_percent' => '25', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'COD 25%, NET15', 'code' => 'C25N15', 'net_days' => '15', 'net_amount' => '0', 'net_percent' => '75', 'cod_amount' => '0', 'cod_percent' => '25', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'COD 25%, NET30', 'code' => 'C25N30', 'net_days' => '30', 'net_amount' => '0', 'net_percent' => '75', 'cod_amount' => '0', 'cod_percent' => '25', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'COD 25%, NET45', 'code' => 'C25N45', 'net_days' => '45', 'net_amount' => '0', 'net_percent' => '75', 'cod_amount' => '0', 'cod_percent' => '25', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'COD 25%, NET60', 'code' => 'C25N60', 'net_days' => '60', 'net_amount' => '0', 'net_percent' => '75', 'cod_amount' => '0', 'cod_percent' => '25', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'COD 25%, NET90', 'code' => 'C25N90', 'net_days' => '90', 'net_amount' => '0', 'net_percent' => '75', 'cod_amount' => '0', 'cod_percent' => '25', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'COD 50%, NET10', 'code' => 'C50N10', 'net_days' => '10', 'net_amount' => '0', 'net_percent' => '50', 'cod_amount' => '0', 'cod_percent' => '50', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'COD 50%, NET15', 'code' => 'C50N15', 'net_days' => '15', 'net_amount' => '0', 'net_percent' => '50', 'cod_amount' => '0', 'cod_percent' => '50', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'COD 50%, NET30', 'code' => 'C50N30', 'net_days' => '30', 'net_amount' => '0', 'net_percent' => '50', 'cod_amount' => '0', 'cod_percent' => '50', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'COD 50%, NET45', 'code' => 'C50N45', 'net_days' => '45', 'net_amount' => '0', 'net_percent' => '50', 'cod_amount' => '0', 'cod_percent' => '50', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'COD 50%, NET60', 'code' => 'C50N60', 'net_days' => '60', 'net_amount' => '0', 'net_percent' => '50', 'cod_amount' => '0', 'cod_percent' => '50', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'COD 50%, NET90', 'code' => 'C50N90', 'net_days' => '90', 'net_amount' => '0', 'net_percent' => '50', 'cod_amount' => '0', 'cod_percent' => '50', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'COD 75%, NET10', 'code' => 'C75N10', 'net_days' => '10', 'net_amount' => '0', 'net_percent' => '25', 'cod_amount' => '0', 'cod_percent' => '75', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'COD 75%, NET15', 'code' => 'C75N15', 'net_days' => '15', 'net_amount' => '0', 'net_percent' => '25', 'cod_amount' => '0', 'cod_percent' => '75', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'COD 75%, NET30', 'code' => 'C75N30', 'net_days' => '30', 'net_amount' => '0', 'net_percent' => '25', 'cod_amount' => '0', 'cod_percent' => '75', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'COD 75%, NET45', 'code' => 'C75N45', 'net_days' => '45', 'net_amount' => '0', 'net_percent' => '25', 'cod_amount' => '0', 'cod_percent' => '75', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'COD 75%, NET60', 'code' => 'C75N60', 'net_days' => '60', 'net_amount' => '0', 'net_percent' => '25', 'cod_amount' => '0', 'cod_percent' => '75', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'COD 75%, NET90', 'code' => 'C75N90', 'net_days' => '90', 'net_amount' => '0', 'net_percent' => '25', 'cod_amount' => '0', 'cod_percent' => '75', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'NET10', 'code' => 'NET10X', 'net_days' => '10', 'net_amount' => '0', 'net_percent' => '100', 'cod_amount' => '0', 'cod_percent' => '0', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'NET15', 'code' => 'NET15X', 'net_days' => '15', 'net_amount' => '0', 'net_percent' => '100', 'cod_amount' => '0', 'cod_percent' => '0', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'NET25', 'code' => 'NET25X', 'net_days' => '25', 'net_amount' => '0', 'net_percent' => '100', 'cod_amount' => '0', 'cod_percent' => '0', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'NET30', 'code' => 'NET30X', 'net_days' => '30', 'net_amount' => '0', 'net_percent' => '100', 'cod_amount' => '0', 'cod_percent' => '0', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'NET45', 'code' => 'NET45X', 'net_days' => '45', 'net_amount' => '0', 'net_percent' => '100', 'cod_amount' => '0', 'cod_percent' => '0', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'NET60', 'code' => 'NET60X', 'net_days' => '60', 'net_amount' => '0', 'net_percent' => '100', 'cod_amount' => '0', 'cod_percent' => '0', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'NET90', 'code' => 'NET90X', 'net_days' => '90', 'net_amount' => '0', 'net_percent' => '100', 'cod_amount' => '0', 'cod_percent' => '0', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
