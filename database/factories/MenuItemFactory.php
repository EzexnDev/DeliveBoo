<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\MenuItem;
use Faker\Generator as Faker;

$factory->define(MenuItem::class, function (Faker $faker) {
    return [
        'restaurant_id' => $faker->numberBetween($min = 1, $max = 20) ,
        'name'=> $faker->word(),
        'description'=> $faker->sentence(),
        'ingredients'=> $faker->word(),
        'price'=>$faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 100),
        'isActive'=> true,
        'isDeleted' => false,
    ];
});
