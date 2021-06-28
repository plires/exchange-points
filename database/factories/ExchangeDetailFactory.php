<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ExchangeDetail;
use Faker\Generator as Faker;

$factory->define(ExchangeDetail::class, function (Faker $faker) {
    return [
    	'product_id' => $faker->numberBetween(1, 20),
			'quantity' => $faker->numberBetween(1, 2),
			'price' => $faker->numberBetween(500, 6000)
    ];
});
