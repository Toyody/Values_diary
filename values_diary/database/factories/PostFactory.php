<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => '1',
        // function() {
        //     return factory(App\User::class)->create()->id;
        // },
        'value_tag' => $faker->text,
        'actions_for_value' => $faker->text,
        'score' => $faker->numberBetween($min = 0, $max = 10),
        'good_things' => $faker->sentence,
        'troubles' => $faker->text,
        'memo' => $faker->text,
        'created_at' => $faker->datetime($max = 'now', $timezone = date_default_timezone_get()),
    ];
});
