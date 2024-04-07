<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'is_admin' => true,
                'active' => true,
                'first_name' => 'System',
                'last_name' => 'Administrator',
                'name' => 'System Administrator',
                'email' => 'admin@thebluskygroup.com',
                'email_verified_at' => now(),
                'password' => Hash::make('L9Red$$Lknta832!@12'),
                'profile_picture_path' => 'storage/profile-pictures/default-profile-picture-male-icon.svg',
                'timezone' => 'America/New_York',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'is_admin' => true,
                'active' => true,
                'first_name' => 'Adam',
                'last_name' => 'Phillips',
                'name' => 'Adam Phillips',
                'email' => 'adamp@aphii.co',
                'email_verified_at' => now(),
                'password' => Hash::make('L9Red$$Lknta832!@12'),
                'profile_picture_path' => 'storage/profile-pictures/8UhGq5a1BcHC1jwDyawGCnYuWgCz1erLA4VS1VVP.jpg',
                'timezone' => 'America/New_York',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'is_admin' => true,
                'active' => true,
                'first_name' => 'Admin',
                'last_name' => 'Account',
                'name' => 'Admin Account',
                'email' => 'admin@aphii.co',
                'email_verified_at' => now(),
                'password' => Hash::make('L9Red$$Lknta832!@12'),
                'profile_picture_path' => 'storage/profile-pictures/default-profile-picture-male-icon.svg',
                'timezone' => 'America/New_York',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'is_employee' => true,
                'active' => true,
                'first_name' => 'Management',
                'last_name' => 'Account',
                'name' => 'Management Account',
                'email' => 'management@aphii.co',
                'email_verified_at' => now(),
                'password' => Hash::make('L9Red$$Lknta832!@12'),
                'profile_picture_path' => 'storage/profile-pictures/default-profile-picture-male-icon.svg',
                'timezone' => 'America/New_York',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'is_employee' => true,
                'active' => true,
                'first_name' => 'Employee',
                'last_name' => 'Account',
                'name' => 'Employee Account',
                'email' => 'employee@aphii.co',
                'email_verified_at' => now(),
                'password' => Hash::make('L9Red$$Lknta832!@12'),
                'profile_picture_path' => 'storage/profile-pictures/default-profile-picture-male-icon.svg',
                'timezone' => 'America/New_York',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'is_client' => true,
                'active' => true,
                'first_name' => 'Client',
                'last_name' => 'Account',
                'name' => 'Client Account',
                'email' => 'client@aphii.co',
                'email_verified_at' => now(),
                'password' => Hash::make('L9Red$$Lknta832!@12'),
                'profile_picture_path' => 'storage/profile-pictures/default-profile-picture-male-icon.svg',
                'timezone' => 'America/New_York',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'is_vendor' => true,
                'active' => true,
                'first_name' => 'Vendor',
                'last_name' => 'Account',
                'name' => 'Vendor Account',
                'email' => 'vendor@aphii.co',
                'email_verified_at' => now(),
                'password' => Hash::make('L9Red$$Lknta832!@12'),
                'profile_picture_path' => 'storage/profile-pictures/default-profile-picture-male-icon.svg',
                'timezone' => 'America/New_York',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
