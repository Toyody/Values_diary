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
        // テストユーザーの価値観

        // 一括削除
        Value::truncate();
        $value_seeds = [
            [
                'user_id' => '2',
                'value' => '思いやり',
                'reason' => '',
                'created_at' => now(),
            ],
            [
                'user_id' => '2',
                'value' => '道徳',
                'reason' => '',
                'created_at' => now(),
            ],
            [
                'user_id' => '2',
                'value' => '親孝行',
                'reason' => '',
                'created_at' => now(),
            ],
            [
                'user_id' => '2',
                'value' => '貢献',
                'reason' => '',
                'created_at' => now(),
            ],
            [
                'user_id' => '2',
                'value' => '成長',
                'reason' => '',
                'created_at' => now(),
            ],
            [
                'user_id' => '2',
                'value' => '愛情',
                'reason' => '',
                'created_at' => now(),
            ],
            [
                'user_id' => '2',
                'value' => '尊重',
                'reason' => '',
                'created_at' => now(),
            ],
            [
                'user_id' => '2',
                'value' => '慈悲',
                'reason' => '',
                'created_at' => now(),
            ],
            [
                'user_id' => '2',
                'value' => '健康',
                'reason' => '',
                'created_at' => now(),
            ],
            [
                'user_id' => '2',
                'value' => '論理的',
                'reason' => '',
                'created_at' => now(),
            ],
            [
                'user_id' => '2',
                'value' => '相手視点',
                'reason' => '',
                'created_at' => now(),
            ],
        ];

        foreach ($value_seeds as $value) {
            DB::table('values')->insert($value);
        }
    }
}
