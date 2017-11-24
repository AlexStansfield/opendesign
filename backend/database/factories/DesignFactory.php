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

$briefs = App\Brief::all()->toArray();
$users = App\User::all()->toArray();

$factory->define(App\Design::class, function (Faker $faker) use ($briefs, $users) {
    return [
        'title' => $faker->name,
        'description' => $faker->text(200),
        'file_name' => $faker->text(32),
        'brief_id' => $faker->randomElement($briefs)['id'],
        'user_id' => $faker->randomElement($users)['id'],
        'status' => $faker->text(32),
    ];
});
