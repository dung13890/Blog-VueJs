<?php

use Illuminate\Database\Seeder;
use App\Eloquent\Page;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Page::class, 20)->create();
    }
}
