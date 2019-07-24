<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_tag_has_articles()
    {
        $tags = create('App\Tag');

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $tags->articles);
    }

}
