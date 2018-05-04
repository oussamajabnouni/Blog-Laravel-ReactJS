<?php


$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->phoneNumber,
        'about' => $faker->sentence(10),
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Article::class, function (Faker\Generator $faker) {

    $title = $faker->sentence;

    return [
        'title' => $title,
        'slug' => str_slug($title),
        'description' => $faker->sentence(15),
        'content' => implode(' ', $faker->paragraphs(2)),
        'published' => true,
        'published_at' => \Carbon\Carbon::now(),
    ];
});
