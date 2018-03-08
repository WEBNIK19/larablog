<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'post_id' => 1,
        'user_id' => 1,
        'comment' => $faker->paragraph,
        'read' => $faker->boolean,
        'created_at' => $faker->unixTime,
    ];
});
