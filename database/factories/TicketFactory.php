<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Ticket;
use Faker\Generator as Faker;

$factory->define(Ticket::class, function (Faker $faker) {
    return [
        'user_id' => User::all()->random()->id,
        'order_id' => $faker->numberBetween(1,200),
        'ticket_type_id' => $faker->numberBetween(1,4),
        'title' => $faker->word,
        'message' => $faker->sentence,
        'status' => $faker->randomElement(['pending','answered','repeated']),
    ];
});
