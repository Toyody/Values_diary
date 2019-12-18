<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Arr;

class PostControllerTest extends TestCase
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
            ->assertSee('日記一覧');
    }

    public function testBoard(): void
    {
        $response = $this
            ->actingAs(User::find(1))
            ->get('/home')
            ->assertViewIs('home')
            ->assertSee('価値観日記へようこそ');

        $response-> assertStatus(200);
    }

    public function testDatabase()
    {
        // アプリケーションを呼び出す…

        $this->assertDatabaseHas('users', [
            'email' => 'toyody0420@gmail.com',
        ]);
    }

    /**
     * カスタムリクエストのバリデーションテスト
     *
     * @param string 項目名
     * @param 値 stringまたはint
     * @param boolean 期待値(true:バリデーションOK、false:バリデーションNG)
     * @dataProvider dataproviderExample
     */
    public function test_日記のバリデーション($item, $data, $expect)
    {
        //入力項目（$item）とその値($data)
        $dataList = [$item => $data];

        $request = new PostRequest();

        //フォームリクエストで定義したルールを取得
        $rules = $request->rules();
        $rules = Arr::only($rules, $item);

        //Validatorファサードでバリデーターのインスタンスを取得、その際に入力情報とバリデーションルールを引数で渡す
        $validator = Validator::make($dataList, $rules);

        //入力情報がバリデーションルールを満たしている場合はtrue、満たしていな場合はfalseが返る
        $result = $validator->passes();

        //期待値($expect)と結果($result)を比較
        $this->assertEquals($expect, $result);
    }

    public function dataproviderExample()
    {
        return [
            // 'value_tags.required' => '価値観を選択してください'
            ['value_tags', '', false],
            ['value_tags', null, false],
            ['value_tags', 'a', true],

            // 'actions_for_value.required' => '価値観に基づいた行動を入力してください'
            ['actions_for_value', '' , false],
            ['actions_for_value', null , false],
            ['actions_for_value', 'a' , true],

            // 'actions_for_value.max' => '価値観に基づいた行動は1000文字以内で入力してください'
            // str_repeat('a', 1001)で、1001文字の文字列を作成(aが1001個できる)
            ['actions_for_value', str_repeat('a', 1001), false],
            ['actions_for_value', str_repeat('a', 1000), true],
            ['actions_for_value', str_repeat('a', 1), true],

            // 'good_things.max' => '良かったことは1000文字以内で入力してください'
            ['good_things', str_repeat('a', 1001), false],
            ['good_things', str_repeat('a', 1000), true],
            ['good_things', str_repeat('a', 1), true],

            // 'troubles.max' => '悩んでいることは1000文字以内で入力してください'
            ['troubles', str_repeat('a', 1001), false],
            ['troubles', str_repeat('a', 1000), true],
            ['troubles', str_repeat('a', 1), true],

            // 'memo.max' => '備考欄は1000文字以内で入力してください'
            ['memo', str_repeat('a', 1001), false],
            ['memo', str_repeat('a', 1000), true],
            ['memo', str_repeat('a', 1), true],
        ];
    }

}
