<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'tag_id' => function() {
            return factory('App\Tag')->create()->id;
        },
        'user_id' => function() {
            return factory('App\User')->create()->id;
        },
        'name' => $faker->name,
        'text' => $faker->text,
        'slug' => $faker->name,
    ];
});
