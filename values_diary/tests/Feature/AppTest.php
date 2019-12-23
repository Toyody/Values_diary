<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\User;
use Auth;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class AppTest extends TestCase
{
    // 各テストメソッドの実行前に呼ばれる
    public function setUp(): void
    {
        parent::setUp();

        // 設定キャッシュをクリア
        Artisan::call('config:clear');

        Artisan::call('migrate:refresh');
        Artisan::call('db:seed');
    }

    public function test_welcome画面の表示(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200)
            ->assertViewIs('welcome')
            ->assertSee('かんたんログイン');
    }

    public function test_ログインユーザーでhome画面の表示(): void
    {
        $response = $this
            ->actingAs(User::find(2)) // テストユーザーのid
            ->get(route('home'));

        $response->assertStatus(200)
            ->assertViewIs('home')
            ->assertSee('価値観日記へようこそ！');
    }

    public function test_ログインユーザーでabout画面の表示(): void
    {
        $response = $this
            ->actingAs(User::find(2))
            ->get(route('about'));

        $response->assertStatus(200)
            ->assertViewIs('about')
            ->assertSee('「価値観日記」とは、自分の価値観のために');
    }

    public function test_ログインユーザーで日記関連の画面を表示(): void
    {
        $response = $this
            ->actingAs(User::find(2))
            ->get(route('posts.index'));

        $response->assertStatus(200)
            ->assertViewIs('posts.index')
            ->assertSee('日記一覧');

        $response = $this
            ->get(route('posts.create'));

        $response->assertStatus(200)
            ->assertViewIs('posts.create')
            ->assertSee('日記を書く');
    }

    public function test_ログインユーザーで価値観関連の画面を表示(): void
    {
        $response = $this
            ->actingAs(User::find(2))
            ->get(route('values.index'));

        $response->assertStatus(200)
            ->assertViewIs('values.index')
            ->assertSee('価値観一覧');

        $response = $this
            ->get(route('values.create'));

        $response->assertStatus(200)
            ->assertViewIs('values.create')
            ->assertSee('価値観を追加');
    }

    public function test_ログインユーザーでグラフ画面の表示(): void
    {
        $response = $this
            ->actingAs(User::find(2))
            ->get(route('graph'));

        $response->assertStatus(200)
            ->assertViewIs('graph')
            ->assertSee('グラフ上にカーソルを乗せると');
    }

    public function test_ログインユーザーでプロフィール関連の画面を表示(): void
    {
        $response = $this
            ->actingAs(User::find(1)) // テストユーザーでは編集画面にいけないので他のアカウントでログイン
            ->get(route('users.show', ['user' => Auth::id()]));

        $response->assertStatus(200)
            ->assertViewIs('users.show')
            ->assertSee('名前');

        $response = $this
            ->get(route('users.edit', ['user' => Auth::id()]));

        $response->assertStatus(200)
            ->assertViewIs('users.edit')
            ->assertSee('編集');
    }
}
