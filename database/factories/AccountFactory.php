<?php

use Faker\Generator as Faker;

$factory->define(App\Account::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->state(App\Account::class, 'withUsers', function () {
    return [];
});

$factory->afterCreatingState(App\Account::class, 'withUsers', function ($account) {
    $account->users()->saveMany(factory(App\User::class, 3)->create());
});

$factory->state(App\Account::class, 'withOrganisations', function () {
    return [];
});

$factory->afterCreatingState(App\Account::class, 'withOrganisations', function ($account) {
    $account->organisations()->saveMany(factory(App\Organisation::class, 3)->create());
});
