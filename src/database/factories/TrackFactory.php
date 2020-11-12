<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Track;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Track::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return factory(User::class)->create(['password' => bcrypt('12345678')]);
        },
        'title'   => $faker->slug(2),
        'artist'  => $faker->name,
    ];
});
