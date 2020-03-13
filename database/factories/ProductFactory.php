<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(1),
        'description' => $faker->paragraph(1),
        'unit' => $faker->randomElement(['meter','kilograms','quantity']),
        'price' =>$faker->randomFloat(2,10,500),
        'total' => $faker->numberBetween(20,999),
        'category_id' => $faker->numberBetween(1,8),

    ];
});
