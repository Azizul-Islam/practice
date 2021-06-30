<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
            'full_name' => 'Azizul Admin',
            'username' => 'Admin',
            'email' => 'cseazizul@gmail.com',
            'password' => Hash::make('password'),
            'address' => 'Pabna',
            'role' => 'admin',
            'status' => 'active',
            ],
            [
            'full_name' => 'Azizul vendor',
            'username' => 'Vendor',
            'email' => 'vendorazizul@gmail.com',
            'password' => Hash::make('password'),
            'address' => 'Pabna',
            'role' => 'vendor',
            'status' => 'active',
            ],
            [
            'full_name' => 'Azizul customer',
            'username' => 'Customer',
            'email' => 'customerazizul@gmail.com',
            'password' => Hash::make('password'),
            'address' => 'Pabna',
            'role' => 'customer',
            'status' => 'active',
            ]
        ]);
    }
}
