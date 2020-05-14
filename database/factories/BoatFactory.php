<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Boat;
use Faker\Generator as Faker;

$factory->define(Boat::class, function (Faker $faker) {
    return [
        'name' => $faker->words(3, true),
        'type' => $faker->randomElement(Boat::BOAT_TYPES),
        'price' => $faker->randomElement(['$', '$$', '$$$']),
        'image' => sprintf('https://picsum.photos/id/%s/200/200', $faker->numberBetween(1, 50)),
    ];
});
