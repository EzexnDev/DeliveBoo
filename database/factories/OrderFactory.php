<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'totalPrice'=> $faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 300),
        'isPayed' => false,
        'notes' => $faker->sentence(),
        'name' => $faker->firstName(),
        'surname' => $faker->lastName(),
        'address' => $faker->streetAddress(),
        'email' => $faker->email(),
        'phone' => $faker->phoneNumber(),
        'created_at' => Carbon::now()->addMonth(rand(1,8))->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->addMonth(rand(1,8))->format('Y-m-d H:i:s')
    ];
});