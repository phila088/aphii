<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\PaymentTerm;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            StateSeeder::class,
            CountySeeder::class,
            CitySeeder::class,
            CitySeeder2::class,
            CitySeeder3::class,
            CitySeeder4::class,
            CitySeeder5::class,
            CitySeeder6::class,
            CitySeeder7::class,
            CitySeeder8::class,
            CitySeeder9::class,
            CitySeeder10::class,
            CitySeeder11::class,
            CitySeeder12::class,
            CitySeeder13::class,
            CitySeeder14::class,
            PaymentTermSeeder::class,
            PaymentMethodSeeder::class,
            ContactDepartmentSeeder::class,
            WorkOrderPrioritySeeder::class,
            StatusCodeSeeder::class,
        ]);
    }
}
