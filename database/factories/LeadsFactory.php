<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Lead;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Lead::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'name' => $faker->name,
        'phones' => $faker->phoneNumber,
        'emails' => $faker->email,
        'sites' => $faker->url,
        'city' => $faker->city,
        'street' => $faker->streetAddress,
        'region' => $faker->state,
        'activity' => $faker->text(15),
        'INN' => $faker->randomNumber(6),
        'KPP' => $faker->randomNumber(6),
        'desc' => $faker->text(100),
        'responsible' => $faker->name,
        'tags' => ''
    ];
});
