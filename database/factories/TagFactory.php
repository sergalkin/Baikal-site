<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Tag;
use Faker\Generator as Faker;

$factory->define(Tag::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return factory('App\User')->create()->id;
        },
        'name' => $faker->name,
    ];
});
