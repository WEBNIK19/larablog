<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
    		'user_id'=>1,
        'header'=>$faker->sentence,
        'demo'=>$faker->sentence(10),
        'post'=>$faker->paragraph(10),
        'allow_comments'=>$faker->boolean,
    ];
});
