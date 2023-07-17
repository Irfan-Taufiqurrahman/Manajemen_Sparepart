<?php

namespace Database\Seeders;

use App\Models\role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        role::create([
            'name' => 'Admin',
        ]);

        role::create([
            'name' => 'Pengawas',
        ]);

        role::create([
            'name' => 'Pelaksana',
        ]);
    }
}
