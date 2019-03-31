<?php

use Faker\Generator as Faker;

$factory->define(App\Organisation::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
    ];
});
