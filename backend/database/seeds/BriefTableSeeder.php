<?php

use Illuminate\Database\Seeder;

class BriefTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Brief::class, 10)->create()->each(function ($project) {
            factory(App\Brief::class)->make();
        });
    }
}
