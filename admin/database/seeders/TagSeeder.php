<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use App\Models\Tags;

class TagSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Tags::create([ 
            'name' => 'coffee_qty',
        ]);

        Tags::create([ 
            'name' => 'milk_qty',
        ]);

        Tags::create([ 
            'name' => 'soya_qty',
        ]);

        Tags::create([ 
            'name' => 'classic_qty',
        ]);

        Tags::create([ 
            'name' => 'brownSugar_qty',
        ]);

        Tags::create([ 
            'name' => 'whiteSugar_qty',
        ]);

        Tags::create([ 
            'name' => 'cocoa_qty',
        ]);

        Tags::create([ 
            'name' => 'creamer_qty',
        ]);

        Tags::create([ 
            'name' => 'frenchVanilla_qty',
        ]);

        Tags::create([ 
            'name' => 'hazelnut_qty',
        ]);

        Tags::create([ 
            'name' => 'butterscotch_qty',
        ]);

        Tags::create([ 
            'name' => 'caramel_qty',
        ]);

        Tags::create([ 
            'name' => 'chocolate_qty',
        ]);

    }
}
