<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use App\Models\Categories;

class CategoriesSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*  insert category  */
        Categories::create([ 
            'name' => 'Coffee',
            'measurement' => '1',
        ]);

        Categories::create([ 
            'name' => 'Syrup',
            'measurement' => '1',
        ]);

        Categories::create([ 
            'name' => 'Choco',
            'measurement' => '1',
        ]);

        Categories::create([ 
            'name' => 'Sugar',
            'measurement' => '1',
        ]);

        Categories::create([ 
            'name' => 'Creamer',
            'measurement' => '1',
        ]);

        Categories::create([ 
            'name' => 'Add-ons',
            'measurement' => '1',
        ]);
    }
}
