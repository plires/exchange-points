<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PointAssigned;
use Faker\Generator as Faker;

$factory->define(PointAssigned::class, function (Faker $faker) {
    return [
       'user_id' => 1,
       'quantity' => $faker->numberBetween(200, 650),
       'author' => 'Pablo Lires'
    ];
});
