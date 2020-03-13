<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\role_user;
use Faker\Generator as Faker;

$factory->define(role_user::class, function (Faker $faker) {
    return [
        'role_id' => $faker->numberBetween(1,8),
        'user_id' => $faker->unique()->numberBetween(1,201),
    ];
});
