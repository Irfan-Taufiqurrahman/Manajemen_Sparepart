<?php

namespace Database\Seeders;

use App\Models\Quality;
use Illuminate\Database\Seeder;

class QualitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Quality::create([
            'name' => 'Good',
        ]);

        Quality::create([
            'name' => 'Medium',
        ]);

        Quality::create([
            'name' => 'Bad',
        ]);
    }
}
