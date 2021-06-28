<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(Category::class)->create([
            'name'          => 'Sin Categoría',
            'description'   => 'Categoría sin descripción',
        ]);

    	for ($i=1; $i <= 5 ; $i++) { 

            factory(Category::class)->create([
            ]);
            
    	}


    }
}
