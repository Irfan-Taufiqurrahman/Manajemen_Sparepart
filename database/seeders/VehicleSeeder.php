<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vehicle::create([
            'name' => 'Espass',
            'colour' => 'biru',
            'tahun_pembuatan' => '2011',
        ]);

        Vehicle::create([
            'name' => 'Test',
            'colour' => 'Merah',
            'tahun_pembuatan' => '2018',
        ]);
    }
}
