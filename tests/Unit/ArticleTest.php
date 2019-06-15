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
    public function an_article_has_owner()
    {
        $article = create('App\Article');

        $this->assertInstanceOf('App\User', $article->owner);
    }
}
