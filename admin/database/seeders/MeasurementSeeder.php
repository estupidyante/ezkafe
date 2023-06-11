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
            'name' => '1 teaspoon',
            'volume' => '1',
            'unit' => 'tsp',
            'price' => '5'
        ]);

        Measurements::create([ 
            'name' => '2 teaspoon',
            'volume' => '2',
            'unit' => 'tsp',
            'price' => '5'
        ]);

        Measurements::create([ 
            'name' => '3 teaspoon',
            'volume' => '3',
            'unit' => 'tsp',
            'price' => '5'
        ]);

        Measurements::create([ 
            'name' => '4 teaspoon',
            'volume' => '4',
            'unit' => 'tsp',
            'price' => '5'
        ]);
    
        Measurements::create([ 
            'name' => '1 tablespoon',
            'volume' => '1',
            'unit' => 'tbsp',
            'price' => '5'
        ]);

        Measurements::create([ 
            'name' => '2 tablespoon',
            'volume' => '2',
            'unit' => 'tbsp',
            'price' => '5'
        ]);

        Measurements::create([ 
            'name' => '3 tablespoon',
            'volume' => '3',
            'unit' => 'tbsp',
            'price' => '5'
        ]);

        Measurements::create([ 
            'name' => '4 tablespoon',
            'volume' => '4',
            'unit' => 'tbsp',
            'price' => '5'
        ]);

    }
}
