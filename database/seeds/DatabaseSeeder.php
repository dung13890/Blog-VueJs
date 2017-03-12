<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoriesSeeder::class);

        if (App::environment('local')) {
            $this->call(UsersSeeder::class);
            $this->call(AbilitiesSeeder::class);
            $this->call(PagesSeeder::class);
            $this->call(PostsSeeder::class);
        }

        $this->call(ConfigsSeeder::class);
    }
}
