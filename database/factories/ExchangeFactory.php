<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Exchange;
use Faker\Generator as Faker;

$factory->define(Exchange::class, function (Faker $faker) {
    return [
    	'points_quantity' => $faker->numberBetween(550, 800)
    ];
});
