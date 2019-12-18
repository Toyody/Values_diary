<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ValueRequest;
use Illuminate\Support\Arr;

class ValueControllerTest extends TestCase
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
     * カスタムリクエストのバリデーションテスト
     *
     * @param string 項目名
     * @param 値 stringまたはint
     * @param boolean 期待値(true:バリデーションOK、false:バリデーションNG)
     * @dataProvider dataproviderExample
     */
    public function test_価値観のバリデーション($item, $data, $expect)
    {
        //入力項目（$item）とその値($data)
        $dataList = [$item => $data];

        $request = new ValueRequest();

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
            // 'value.required' => '価値観を入力してください'
            ['value', '', false],

            // 'value.max' => '価値観は10文字以内で入力してください'
            // str_repeat('a', 11)で、11文字の文字列を作成(aが11個できる)
            ['value', str_repeat('a', 11), false],
            ['value', str_repeat('a', 10), true],
            ['value', str_repeat('a', 5), true],

            //'value.unique' => 'すでに同じ価値観が追加されています'
            // ['value', '思いやり'],

            // 'reason.max' => '理由は1000文字以内で入力してください'
            ['reason', str_repeat('a', 1001), false],
            ['reason', str_repeat('a', 2000), false],
            ['reason', str_repeat('a', 1000), true],
            ['reason', str_repeat('a', 100), true],
        ];
    }
}
