<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Eloquent\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'username' => $faker->unique()->userName,
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = 'secret',
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Eloquent\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence(4, false),
        'type' => $faker->randomElement(config('settings.categories')),
        'description' => $faker->text,
        'locked' => rand(0, 1),
    ];
});

$factory->define(App\Eloquent\Post::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence(5, false),
        'description' => $faker->text,
        'content' => $faker->paragraph(15, true),
        'user_id' => 1,
        'featured' => rand(0, 1),
        'locked' => rand(0, 1),
        'image' => '2017/03/backend/1/post/no_image.jpg',
    ];
});

$factory->define(App\Eloquent\Page::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence(5, false),
        'description' => $faker->text,
        'content' => $faker->paragraph(15, true),
        'locked' => rand(0, 1),
    ];
});
