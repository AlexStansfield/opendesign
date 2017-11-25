<?php

use Illuminate\Database\Seeder;

class DesignTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Design::class, 10)->create()->each(function ($project) {
            factory(App\Design::class)->make();
        });
    }
}
