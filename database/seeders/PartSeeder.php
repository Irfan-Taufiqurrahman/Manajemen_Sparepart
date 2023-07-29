<?php

namespace Database\Seeders;

use App\Models\Part;
use Illuminate\Database\Seeder;

class PartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Part::create([
            'name' => 'Ban',
        ]);

        Part::create([
            'name' => 'Oli',
        ]);

        Part::create([
            'name' => 'Odo Kilometer',
        ]);

        Part::create([
            'name' => 'Wiper',
        ]);

        Part::create([
            'name' => 'Air Radiator',
        ]);

        Part::create([
            'name' => 'Rem',
        ]);

        Part::create([
            'name' => 'Lampu Rem',
        ]);

        Part::create([
            'name' => 'Lampu Depan',
        ]);

        Part::create([
            'name' => 'Lampu Sen',
        ]);
    }
}
