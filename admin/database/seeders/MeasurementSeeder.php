<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use App\Models\Measurements;

class MeasurementSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Measurements::create([ 
            'name' => '1 tsp',
            'volume' => '1',
            'unit' => 'tsp',
            'price' => '5'
        ]);

        Measurements::create([ 
            'name' => '2 tsp',
            'volume' => '2',
            'unit' => 'tsp',
            'price' => '5'
        ]);

        Measurements::create([ 
            'name' => '1 tbsp',
            'volume' => '1',
            'unit' => 'tbsp',
            'price' => '5'
        ]);

        Measurements::create([ 
            'name' => '2 tbsp',
            'volume' => '2',
            'unit' => 'tbsp',
            'price' => '5'
        ]);

    }
}
