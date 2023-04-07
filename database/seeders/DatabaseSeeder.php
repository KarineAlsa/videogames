<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //\App\Models\videogame::factory(10)->create();
        //\App\Models\purchase::factory(10)->create();
        \App\Models\user::factory(1)->create();

    }
}
