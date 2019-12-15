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
        // 練習
        $response = $this
            ->actingAs(User::find(1))
            ->get('/posts');

        $response->assertStatus(200)
            ->assertViewIs('posts.index')
            ->assertSee('日記一覧');
    }
}
