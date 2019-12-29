<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Review;
use Faker\Generator as Faker;

$factory->define(Review::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween($min = 1, $max = 6),
        'product_id' => $faker->numberBetween($min = 1, $max = 29),
        'star' => $faker->numberBetween($min = 1, $max = 5),
        'review' => $faker->sentence($nbWords = 13, $variableNbWords = true),
    ];
});
