<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function an_article_can_make_string_path()
    {
        $article = create('App\Article');
        $this->assertEquals("/article/$article->slug", $article->path());
    }

    /** @test */
    public function an_article_has_owner()
    {
        $article = create('App\Article');

        $this->assertInstanceOf('App\User', $article->owner);
    }

    /** @test */
    public function an_article_has_name()
    {
        $article = create('App\Article');

        $this->assertNotEmpty($article->name);
    }

    /** @test */
    public function an_article_has_tag()
    {
        $tags = create('App\Tag');
        $article = create('App\Article');
        $article->tags()->attach($tags);

        $this->assertNotEmpty($article->tags);
    }

    /** @test */
    public function an_article_has_text()
    {
        $article = create('App\Article');

        $this->assertNotEmpty($article->text);
    }

    /** @test */
    public function an_article_has_slug()
    {
        $article = create('App\Article');

        $this->assertNotEmpty($article->slug);
    }

    /** @test */
    public function an_article_can_add_comment()
    {
        $article = create('App\Article');
        $article->addComment([
            'body' => 'Foobar',
            'user_id' => 1
        ]);

        $this->assertCount(1, $article->comments);
    }
}
