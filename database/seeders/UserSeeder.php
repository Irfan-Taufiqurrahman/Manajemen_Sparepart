<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'irfan',
            'number_phone' => '082141689861',
            'password' => bcrypt('12345678'),
            'role_id' => 1,
        ]);

        User::create([
            'name' => 'John Doe',
            'number_phone' => '1234567890',
            'password' => bcrypt('12345678'),
            'role_id' => 2,
        ]);

        User::create([
            'name' => 'Jane Smith',
            'number_phone' => '9876543210',
            'password' => bcrypt('12345678'),
            'role_id' => 2,
        ]);

        User::create([
            'name' => 'nizam',
            'number_phone' => '082141689862',
            'password' => bcrypt('12345678'),
            'role_id' => 3,
        ]);

        User::create([
            'name' => 'Alice Johnson',
            'number_phone' => '5555555555',
            'password' => bcrypt('12345678'),
            'role_id' => 3,
        ]);
    }
}
