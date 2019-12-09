<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this
            ->actingAs(User::find(1))
            ->get('/posts');

        $response->assertStatus(200)
            ->assertViewIs('posts.index')
            ->assertSee('投稿一覧');
    }
}
