<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleTest extends TestCase
{
    use DatabaseMigrations;

    protected $article;

    public function setUp(): void
    {
        parent::setUp();
        $this->article = create('App\Article');
    }

    /** @test */
    public function a_user_can_view_all_articles()
    {
        $response = $this->get('/articles');
        $response->assertSee($this->article->name);
    }
}
