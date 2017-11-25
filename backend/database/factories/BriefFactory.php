<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
$projects = App\Project::all();
$users = App\User::all();

$factory->define(App\Brief::class, function (Faker $faker) use ($projects, $users) {
    return [
        'project_id' => ($faker->randomElement($projects->toArray()))['id'],
        'user_id' => ($faker->randomElement($users->toArray()))['id'],
        'title' => $faker->text(32),
        'description' => $faker->text(32),
        'type' => $faker->text(6),
        'status' => $faker->text(6),
    ];
});
