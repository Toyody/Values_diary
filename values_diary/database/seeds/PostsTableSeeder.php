<?php

declare(strict_types=1);

use App\Post;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 一括削除
        Post::truncate();

        date_default_timezone_set('Asia/Tokyo');

        $post_seeds = [
            [
            'user_id' => '2',
            'value_tags' => '思いやり',
            'actions_for_value' => 'こんなことをしました・・・',
            'score' => '7',
            'good_things' => 'こんないいことがありました・・・',
            'troubles' => 'こんなことで悩んでいます・・・',
            'memo' => 'もっとこうすればよかった・・・',
            'created_at' => date('Y/m/d H:i:s', strtotime('-1 day')),
            ],
            [
            'user_id' => '2',
            'value_tags' => '愛情',
            'actions_for_value' => 'こんなことをしました・・・',
            'score' => '3',
            'good_things' => 'こんないいことがありました・・・',
            'troubles' => 'こんなことで悩んでいます・・・',
            'memo' => 'もっとこうすればよかった・・・',
            'created_at' => date('Y/m/d H:i:s', strtotime('-2 day')),
            ],
            [
            'user_id' => '2',
            'value_tags' => '道徳',
            'actions_for_value' => 'こんなことをしました・・・',
            'score' => '5',
            'good_things' => 'こんないいことがありました・・・',
            'troubles' => 'こんなことで悩んでいます・・・',
            'memo' => 'もっとこうすればよかった・・・',
            'created_at' => date('Y/m/d H:i:s', strtotime('-3 day')),
            ],
            [
            'user_id' => '2',
            'value_tags' => '相手視点',
            'actions_for_value' => 'こんなことをしました・・・',
            'score' => '10',
            'good_things' => 'こんないいことがありました・・・',
            'troubles' => 'こんなことで悩んでいます・・・',
            'memo' => 'もっとこうすればよかった・・・',
            'created_at' => date('Y/m/d H:i:s', strtotime('-4 day')),
            ],
            [
            'user_id' => '2',
            'value_tags' => '論理的',
            'actions_for_value' => 'こんなことをしました・・・',
            'score' => '3',
            'good_things' => 'こんないいことがありました・・・',
            'troubles' => 'こんなことで悩んでいます・・・',
            'memo' => 'もっとこうすればよかった・・・',
            'created_at' => date('Y/m/d H:i:s', strtotime('-5 day')),
            ],
            [
            'user_id' => '2',
            'value_tags' => '道徳',
            'actions_for_value' => 'こんなことをしました・・・',
            'score' => '2',
            'good_things' => 'こんないいことがありました・・・',
            'troubles' => 'こんなことで悩んでいます・・・',
            'memo' => 'もっとこうすればよかった・・・',
            'created_at' => date('Y/m/d H:i:s', strtotime('-6 day')),
            ],
            [
            'user_id' => '2',
            'value_tags' => '健康',
            'actions_for_value' => 'こんなことをしました・・・',
            'score' => '4',
            'good_things' => 'こんないいことがありました・・・',
            'troubles' => 'こんなことで悩んでいます・・・',
            'memo' => 'もっとこうすればよかった・・・',
            'created_at' => date('Y/m/d H:i:s', strtotime('-7 day')),
            ],
            [
            'user_id' => '2',
            'value_tags' => '相手視点',
            'actions_for_value' => 'こんなことをしました・・・',
            'score' => '9',
            'good_things' => 'こんないいことがありました・・・',
            'troubles' => 'こんなことで悩んでいます・・・',
            'memo' => 'もっとこうすればよかった・・・',
            'created_at' => date('Y/m/d H:i:s', strtotime('-8 day')),
            ],
            [
            'user_id' => '2',
            'value_tags' => '論理',
            'actions_for_value' => 'こんなことをしました・・・',
            'score' => '10',
            'good_things' => 'こんないいことがありました・・・',
            'troubles' => 'こんなことで悩んでいます・・・',
            'memo' => 'もっとこうすればよかった・・・',
            'created_at' => date('Y/m/d H:i:s', strtotime('-9 day')),
            ],
            [
            'user_id' => '2',
            'value_tags' => '成長',
            'actions_for_value' => 'こんなことをしました・・・',
            'score' => '0',
            'good_things' => 'こんないいことがありました・・・',
            'troubles' => 'こんなことで悩んでいます・・・',
            'memo' => 'もっとこうすればよかった・・・',
            'created_at' => date('Y/m/d H:i:s', strtotime('-10 day')),
            ],
            [
            'user_id' => '2',
            'value_tags' => '尊重',
            'actions_for_value' => 'こんなことをしました・・・',
            'score' => '2',
            'good_things' => 'こんないいことがありました・・・',
            'troubles' => 'こんなことで悩んでいます・・・',
            'memo' => 'もっとこうすればよかった・・・',
            'created_at' => date('Y/m/d H:i:s', strtotime('-11 day')),
            ],
            [
            'user_id' => '2',
            'value_tags' => '慈悲',
            'actions_for_value' => 'こんなことをしました・・・',
            'score' => '5',
            'good_things' => 'こんないいことがありました・・・',
            'troubles' => 'こんなことで悩んでいます・・・',
            'memo' => 'もっとこうすればよかった・・・',
            'created_at' => date('Y/m/d H:i:s', strtotime('-12 day')),
            ],
            [
            'user_id' => '2',
            'value_tags' => '親孝行',
            'actions_for_value' => 'こんなことをしました・・・',
            'score' => '10',
            'good_things' => 'こんないいことがありました・・・',
            'troubles' => 'こんなことで悩んでいます・・・',
            'memo' => 'もっとこうすればよかった・・・',
            'created_at' => date('Y/m/d H:i:s', strtotime('-13 day')),
            ],
            [
            'user_id' => '2',
            'value_tags' => '思いやり',
            'actions_for_value' => 'こんなことをしました・・・',
            'score' => '8',
            'good_things' => 'こんないいことがありました・・・',
            'troubles' => 'こんなことで悩んでいます・・・',
            'memo' => 'もっとこうすればよかった・・・',
            'created_at' => date('Y/m/d H:i:s', strtotime('-14 day')),
            ],
            [
            'user_id' => '2',
            'value_tags' => '相手視点',
            'actions_for_value' => 'こんなことをしました・・・',
            'score' => '7',
            'good_things' => 'こんないいことがありました・・・',
            'troubles' => 'こんなことで悩んでいます・・・',
            'memo' => 'もっとこうすればよかった・・・',
            'created_at' => date('Y/m/d H:i:s', strtotime('-15 day')),
            ],
            [
            'user_id' => '2',
            'value_tags' => '成長',
            'actions_for_value' => 'こんなことをしました・・・',
            'score' => '4',
            'good_things' => 'こんないいことがありました・・・',
            'troubles' => 'こんなことで悩んでいます・・・',
            'memo' => 'もっとこうすればよかった・・・',
            'created_at' => date('Y/m/d H:i:s', strtotime('-16 day')),
            ],
            [
            'user_id' => '2',
            'value_tags' => '愛情',
            'actions_for_value' => 'こんなことをしました・・・',
            'score' => '7',
            'good_things' => 'こんないいことがありました・・・',
            'troubles' => 'こんなことで悩んでいます・・・',
            'memo' => 'もっとこうすればよかった・・・',
            'created_at' => date('Y/m/d H:i:s', strtotime('-17 day')),
            ],
            [
            'user_id' => '2',
            'value_tags' => '健康',
            'actions_for_value' => 'こんなことをしました・・・',
            'score' => '9',
            'good_things' => 'こんないいことがありました・・・',
            'troubles' => 'こんなことで悩んでいます・・・',
            'memo' => 'もっとこうすればよかった・・・',
            'created_at' => date('Y/m/d H:i:s', strtotime('-18 day')),
            ],
            [
            'user_id' => '2',
            'value_tags' => '論理的',
            'actions_for_value' => 'こんなことをしました・・・',
            'score' => '2',
            'good_things' => 'こんないいことがありました・・・',
            'troubles' => 'こんなことで悩んでいます・・・',
            'memo' => 'もっとこうすればよかった・・・',
            'created_at' => date('Y/m/d H:i:s', strtotime('-19 day')),
            ],
            [
            'user_id' => '2',
            'value_tags' => '貢献',
            'actions_for_value' => 'こんなことをしました・・・',
            'score' => '6',
            'good_things' => 'こんないいことがありました・・・',
            'troubles' => 'こんなことで悩んでいます・・・',
            'memo' => 'もっとこうすればよかった・・・',
            'created_at' => date('Y/m/d H:i:s', strtotime('-20 day')),
            ],
        ];

        foreach ($post_seeds as $post) {
            DB::table('posts')->insert($post);
        }
    }
}
