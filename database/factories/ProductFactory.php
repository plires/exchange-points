<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'sku' 				=> $faker->unique()->word(),
        'name' 				=> $faker->sentence(2, false),
        'description' 	    => $faker->paragraph(),
        'price' 			=> $faker->numberBetween(500, 6000),
        'category_id' 	    => $faker->numberBetween(1, 5),
        'availability' 	    => 50,
        'featured' 			=> $faker->numberBetween(0, 1),
        'is_active' 		=> 1,
        'image' 			=> $faker->imageUrl(400, 400)
    ];
});
