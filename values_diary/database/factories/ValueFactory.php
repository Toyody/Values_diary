<?php

declare(strict_types=1);

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Value;
use Faker\Generator as Faker;

$factory->define(Value::class, function (Faker $faker) {
    return [
        'user_id' => '1',
        'value' => $faker->text($max = 24),
        'reason' => $faker->text,
        'created_at' => $faker->datetime($max = 'now', $timezone = date_default_timezone_get()),
    ];
});
