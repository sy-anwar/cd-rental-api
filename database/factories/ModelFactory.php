<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\CdCollection::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->text,
        'rate' => $faker->randomDigitNotNull,
        'category' => $faker->word,
        'quantity' => $faker->randomDigitNotNull,
    ];
});

$factory->define(App\Rent::class, function (Faker\Generator $faker) {
    return [
        'customer' => $faker->text,
        'id_cd' => $faker->randomDigitNotNull,
        'price' => 0,
    ];
});
