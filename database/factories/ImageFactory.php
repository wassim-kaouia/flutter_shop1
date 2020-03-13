<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Image;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Image::class, function (Faker $faker) {
    return [
        'url' => $faker->imageUrl(800,600),
        'product_id' => Product::all()->random()->id,
    ];
});
