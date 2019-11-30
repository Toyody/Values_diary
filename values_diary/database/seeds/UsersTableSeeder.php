<?php

declare(strict_types=1);

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 一括削除
        User::truncate();

        DB::table('users')->insert([
            'name' => 'toyody',
            'email' => 'toyody0420@gmail.com',
            'password' => bcrypt('password'),
            'created_at' => now(),
        ]);
    }
}
