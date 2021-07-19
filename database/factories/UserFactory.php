<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {

    return [
        'name'                  => $faker->firstName,
        'lastname'              => $faker->lastName,
        'document'              => $faker->numberBetween($min = 20000000, $max = 30000000),
        'email'                 => $faker->unique()->safeEmail,
        'birthday'              => $faker->date($format = 'Y-m-d', $max = 'now'),
        'phone'                 => $faker->phoneNumber,
        'street'                => $faker->streetAddress,
        'street_number'         => $faker->numberBetween($min = 100, $max = 3500),
        'city'                  => $faker->city,
        'province'              => $faker->state,
        'country'               => $faker->country,
        'postal_code'           => $faker->postcode,
        'points'                => $faker->numberBetween($min = 600, $max = 18000),
        'image'                 => $faker->imageUrl(150, 150),
        'role_id'               => 2,
        'email_verified_at'     => now(),
        'password'              => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token'        => Str::random(10),
    ];
});
