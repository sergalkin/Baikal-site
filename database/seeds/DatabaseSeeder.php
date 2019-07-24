<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create 50 article with 50 users
        factory(App\Article::class, 50)->create();

        factory(App\Tag::class, 10)->create();

        $tags = App\Tag::all();
        $users = App\User::all();
        $faker = Faker\Factory::create();

        App\Article::all()->each(function($article) use ($tags, $users, $faker) {
            $article->tags()->attach(
                $tags->random(rand(1, $tags->count()))->pluck('id')->toArray()
            );

            $article->addComment([
                'body' => $faker->text,
                'user_id' => rand(1, $users->count())
            ]);
        });
    }
}
