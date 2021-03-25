<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Restaurant;
use Faker\Generator as Faker;

$factory->define(Restaurant::class, function (Faker $faker) {
    
    return [
        'user_id' => $faker->unique()->numberBetween($min = 1, $max = 20 ),
        'address' => $faker->streetAddress(),
        'description'=> $faker->paragraph($nbSentences = 3, $variableNbSentences = true), 
        'imgUrl' => 'https://picsum.photos/300/200?random=' . $faker->unique()->numberBetween($min = 1, $max = 800),
        'isActive' => true,
        'deliveryHours' => '12:00 / 23:00',
        'closeDay' => $faker->dayOfWeek(),
        'shortDescription' => $faker->sentence(), 
        'name' => $faker->word(),
        'phone' => $faker->phoneNumber(),
        'city' => 'Roma',
    ];
});
