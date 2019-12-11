<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testExample(): void
    {
        $response = $this
            ->actingAs(User::find(1))
            ->get('/posts');

        $response->assertStatus(200)
            ->assertViewIs('posts.index')
            ->assertSee('投稿一覧');
    }
}
