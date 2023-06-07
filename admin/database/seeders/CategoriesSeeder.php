<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use App\Models\Category;

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
        Category::create([ 
            'name' => 'Coffee',
        ]);

        Category::create([ 
            'name' => 'Syrup',
        ]);

        Category::create([ 
            'name' => 'Choco',
        ]);

        Category::create([ 
            'name' => 'Sugar',
        ]);

        Category::create([ 
            'name' => 'Creamer',
        ]);

        Category::create([ 
            'name' => 'Add-ons',
        ]);
    }
}
