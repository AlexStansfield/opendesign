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

$factory->define(App\Brief::class, function (Faker $faker) {
    $projects = App\Project::all()->toArray();
    $users = App\User::all()->toArray();

    return [
        'project_id' => $faker->randomElement($projects)['id'],
        'user_id' => $faker->randomElement($users)['id'],
        'title' => $faker->text(32),
        'description' => $faker->text(32),
        'type' => $faker->text(6),
        'status' => $faker->text(6),
    ];
});
