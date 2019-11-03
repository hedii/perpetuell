<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Song;
use App\User;
use Faker\Generator as Faker;

$factory->define(Song::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(),
        'user_id' => function () {
            return factory(User::class)->create()->id;
        }
    ];
});
