<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Carbon\Carbon;

$factory->define(Post::class, function (Faker $faker) {

    $title = $faker->sentence;

    return [
        'title' => $title,
        'slug' => Str::slug($title),
        'description' => $faker->paragraph,
        'user_id' => factory(App\User::class),
        'publication_date' => Carbon::now()
    ];
});
