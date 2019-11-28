<?php

use Illuminate\Database\Seeder;
use App\Value;

class ValuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Value::class, 35)->create();
    }
}
