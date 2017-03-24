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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Wrestler::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
        'hometown' => $faker->city . ', ' . $faker->state,
        'height' => $faker->numberBetween(63, 84),
        'weight' => $faker->numberBetween(175, 400)
    ];
});

$factory->define(App\Manager::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
        'hometown' => $faker->city . ', ' . $faker->state,
        'height' => $faker->numberBetween(63, 84),
        'weight' => $faker->numberBetween(175, 400)
    ];
});

$factory->define(App\Title::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->sentence(3),
    ];
});

$factory->define(App\Match::class, function (Faker\Generator $faker) {

    return [
        'event_id' => function () {
            return factory(Event::class)->create()->id;
        },
        'match_number' => $faker->sentence(3),
    ];
});

$factory->define(App\Event::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->sentence(3),
    ];
});
