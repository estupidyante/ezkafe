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
            'label' => '1 teaspoon',
            'name' => '1 teaspoon',
            'volume' => '1',
            'unit' => 'tsp',
            'price' => '5'
        ]);

        Measurements::create([
            'label' => '2 teaspoon',
            'name' => '2 teaspoon',
            'volume' => '2',
            'unit' => 'tsp',
            'price' => '6'
        ]);

        Measurements::create([
            'label' => '3 teaspoon',
            'name' => '3 teaspoon',
            'volume' => '3',
            'unit' => 'tsp',
            'price' => '7'
        ]);

        Measurements::create([
            'label' => '4 teaspoon',
            'name' => '4 teaspoon',
            'volume' => '4',
            'unit' => 'tsp',
            'price' => '8'
        ]);
    
        Measurements::create([
            'label' => '1 tablespoon',
            'name' => '1 tablespoon',
            'volume' => '1',
            'unit' => 'tbsp',
            'price' => '5'
        ]);

        Measurements::create([
            'label' => '2 tablespoon',
            'name' => '2 tablespoon',
            'volume' => '2',
            'unit' => 'tbsp',
            'price' => '6'
        ]);

        Measurements::create([
            'label' => '3 tablespoon',
            'name' => '3 tablespoon',
            'volume' => '3',
            'unit' => 'tbsp',
            'price' => '7'
        ]);

        Measurements::create([
            'label' => '4 tablespoon',
            'name' => '4 tablespoon',
            'volume' => '4',
            'unit' => 'tbsp',
            'price' => '8'
        ]);

    }
}
