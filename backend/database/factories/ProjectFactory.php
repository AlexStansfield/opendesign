<?php

use Faker\Generator as Faker;

$factory->define(App\Project::class, function (Faker $faker) {
    return [
        'id' => $faker->randomNumber(3),
        'github_id' => $faker->randomNumber(4),
        'name' => $faker->name('male'),
        'description' => $faker->text(220),
        'repo' => $faker->text(120),
        'link' => $faker->text(120),
        'type' => $faker->text(10),
    ];
});
