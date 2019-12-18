<?php

declare(strict_types=1);

use App\Value;
use Illuminate\Database\Seeder;

class ValuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        factory(Value::class, 12)->create();

        // テストユーザーの価値観
        DB::table('values')->insert([
            'user_id' => '2',
            'value' => '思いやり',
            'reason' => '昔にこういうことがあったのがきっかけ',
            'created_at' => now(),
        ]);
    }
}
