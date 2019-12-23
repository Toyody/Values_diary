<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Http\Requests\UserRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class UserControllerTest extends TestCase
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
     * カスタムリクエストのバリデーションテスト.
     *
     * @param string 項目名
     * @param 値 stringまたはint
     * @param bool 期待値(true:バリデーションOK、false:バリデーションNG)
     * @param mixed $item
     * @param mixed $data
     * @param mixed $expect
     * @dataProvider dataproviderExample
     */
    public function test_プロフィールのバリデーション($item, $data, $expect): void
    {
        //入力項目（$item）とその値($data)
        $dataList = [$item => $data];

        $request = new UserRequest();

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
            // 'name.required' => '名前を入力してください'
            ['name', '', false],
            ['name', null, false],
            ['name', 'a', true],

            // 'name.max' => '名前は24文字以内で入力してください'
            // str_repeat('a', 25)で、1001文字の文字列を作成(aが25個できる)
            ['name', str_repeat('a', 25), false],
            ['name', str_repeat('a', 24), true],
            ['name', str_repeat('a', 1), true],

            // 'profile_image.file' => '写真にはファイルを指定してください'
            // 'profile_image.image' => '写真には画像ファイルを指定してください'
            // 'profile_image.mimes' => '写真にはjpeg,png,jpg,gifのうちいずれかの形式のファイルを指定してください'
            ['profile_image', 1, false],
            ['profile_image', 'a', false],
            ['profile_image', UploadedFile::fake()->create('dummy'), false],
            ['profile_image', UploadedFile::fake()->create('dummy.jpeg'), true],
            ['profile_image', UploadedFile::fake()->create('dummy.png'), true],
            ['profile_image', UploadedFile::fake()->create('dummy.jpg'), true],
            ['profile_image', UploadedFile::fake()->create('dummy.gif'), true],
            ['profile_image', UploadedFile::fake()->create('dummy.txt'), false],
            ['profile_image', UploadedFile::fake()->create('dummy.csv'), false],

            // 'email.required' => 'メールアドレスを入力してください'
            ['email', '', false],
            ['email', null, false],

            // 'email.email' => '正しい形式のメールアドレスを入力してください'
            ['email', 1, false],
            ['email', 'dummy', false],
            ['email', 'd..ummy@example', false],
            ['email', 'dummy.@example', false],
            ['email', 'dummy@example.com', true],

            // 'email.unique' => 'すでに使用されているメールアドレスです'
            // ※test@example.comはseederで注入済み
            ['email', 'test@example.com', false],

            // 'ideal.max' => 'どんな自分でありたいかは1000文字以内で入力してください'
            ['ideal', str_repeat('a', 1001), false],
            ['ideal', str_repeat('a', 1000), true],
            ['ideal', str_repeat('a', 1), true],
        ];
    }

    public function test_プロフィール写真のアップロード(): void
    {
        Storage::fake('profile_images');

        $uploadedFile = UploadedFile::fake()->image('profile_image.jpg');

        $uploadedFile->move('storage/framework/testing/disks/profile_images');

        Storage::disk('profile_images')->assertExists($uploadedFile->getFilename());
    }
}
