<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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
