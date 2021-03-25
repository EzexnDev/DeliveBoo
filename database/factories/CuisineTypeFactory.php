<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CuisineType;
use Faker\Generator as Faker;

$factory->define(CuisineType::class, function (Faker $faker) {
    return [
        'type' => $faker->unique()->word(),
    ];
});
