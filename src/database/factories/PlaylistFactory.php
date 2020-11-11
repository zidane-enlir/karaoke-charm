<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\User;
use App\Models\Playlist;
use Illuminate\Support\Str;

$factory->define(Playlist::class, function (Faker $faker) {
    return [
        // 'user_id' => range(3,102),
        // 'user_id' => $faker->unique->numberBetween(3,102),

        // 'user_id' => mt_rand(1, 100),

        'user_id' => function() {
            return factory(User::class)->create(['password' => bcrypt('12345678')]);
        },
        'name' => $faker->randomElement(
                    $array = [
                        'アニメ', 
                        'ボーカロイド', 
                        'インディーズ', 
                        '洋楽', 
                        '演歌', 
                        '本人映像 (DAM)',
                        '本人映像 (JOYSOUND)',
                        'バラード',
                    ]),
    ];
});
