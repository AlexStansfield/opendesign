<?php

use Faker\Generator as Faker;

$designs = App\Design::all();

$factory->define(App\DesignAsset::class, function (Faker $faker) use ($designs) {
    return [
        'design_id' => $faker->randomElement($designs)['id'],
        'file_name' => $faker->text(56),
    ];
});
