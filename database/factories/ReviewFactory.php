<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Review;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Review::class, function (Faker $faker) {
    return [
        'user_id' => User::all()->random()->id,
        'product_id' => Product::all()->random()->id,
        'stars' => $faker->numberBetween(1,5),
        'review' => $faker->sentence(1),
    ];
});
