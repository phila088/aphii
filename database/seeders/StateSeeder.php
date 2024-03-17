<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('states')->insert([
            ['id' => '1', 'name' => 'Alaska', 'code' => 'AK', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '2', 'name' => 'Alabama', 'code' => 'AL', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '3', 'name' => 'Arkansas', 'code' => 'AR', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '4', 'name' => 'American Samoa', 'code' => 'AS', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '5', 'name' => 'Arizona', 'code' => 'AZ', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '6', 'name' => 'California', 'code' => 'CA', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '7', 'name' => 'Colorado', 'code' => 'CO', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '8', 'name' => 'Connecticut', 'code' => 'CT', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '9', 'name' => 'District of Columbia', 'code' => 'DC', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '10', 'name' => 'Delaware', 'code' => 'DE', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '11', 'name' => 'Florida', 'code' => 'FL', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '12', 'name' => 'Georgia', 'code' => 'GA', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '13', 'name' => 'Guam', 'code' => 'GU', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '14', 'name' => 'Hawaii', 'code' => 'HI', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '15', 'name' => 'Iowa', 'code' => 'IA', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '16', 'name' => 'Idaho', 'code' => 'ID', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '17', 'name' => 'Illinois', 'code' => 'IL', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '18', 'name' => 'Indiana', 'code' => 'IN', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '19', 'name' => 'Kansas', 'code' => 'KS', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '20', 'name' => 'Kentucky', 'code' => 'KY', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '21', 'name' => 'Louisiana', 'code' => 'LA', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '22', 'name' => 'Massachusetts', 'code' => 'MA', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '23', 'name' => 'Maryland', 'code' => 'MD', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '24', 'name' => 'Maine', 'code' => 'ME', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '25', 'name' => 'Michigan', 'code' => 'MI', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '26', 'name' => 'Minnesota', 'code' => 'MN', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '27', 'name' => 'Missouri', 'code' => 'MO', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '28', 'name' => 'Northern Mariana Islands', 'code' => 'MP', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '29', 'name' => 'Mississippi', 'code' => 'MS', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '30', 'name' => 'Montana', 'code' => 'MT', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '31', 'name' => 'North Carolina', 'code' => 'NC', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '32', 'name' => 'North Dakota', 'code' => 'ND', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '33', 'name' => 'Nebraska', 'code' => 'NE', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '34', 'name' => 'New Hampshire', 'code' => 'NH', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '35', 'name' => 'New Jersey', 'code' => 'NJ', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '36', 'name' => 'New Mexico', 'code' => 'NM', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '37', 'name' => 'Nevada', 'code' => 'NV', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '38', 'name' => 'New York', 'code' => 'NY', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '39', 'name' => 'Ohio', 'code' => 'OH', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '40', 'name' => 'Oklahoma', 'code' => 'OK', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '41', 'name' => 'Oregon', 'code' => 'OR', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '42', 'name' => 'Pennsylvania', 'code' => 'PA', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '43', 'name' => 'Puerto Rico', 'code' => 'PR', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '44', 'name' => 'Rhode Island', 'code' => 'RI', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '45', 'name' => 'South Carolina', 'code' => 'SC', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '46', 'name' => 'South Dakota', 'code' => 'SD', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '47', 'name' => 'Tennessee', 'code' => 'TN', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '48', 'name' => 'Texas', 'code' => 'TX', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '49', 'name' => 'Utah', 'code' => 'UT', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '50', 'name' => 'Virginia', 'code' => 'VA', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '51', 'name' => 'Virgin Islands', 'code' => 'VI', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '52', 'name' => 'Vermont', 'code' => 'VT', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '53', 'name' => 'Washington', 'code' => 'WA', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '54', 'name' => 'Wisconsin', 'code' => 'WI', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '55', 'name' => 'West Virginia', 'code' => 'WV', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => '56', 'name' => 'Wyoming', 'code' => 'WY', 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],

        ]);
    }
}
