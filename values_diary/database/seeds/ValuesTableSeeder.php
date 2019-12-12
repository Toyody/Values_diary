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
    }
}
