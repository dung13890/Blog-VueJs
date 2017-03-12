<?php

use Illuminate\Database\Seeder;
use App\Eloquent\Config;

class ConfigsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app(Config::class)->create([
            'key' => 'title',
            'value' => 'My Blog',
        ]);

        app(Config::class)->create([
            'key' => 'keywords',
            'value' => 'keyword',
        ]);

        app(Config::class)->create([
            'key' => 'description',
            'value' => 'description',
        ]);

        app(Config::class)->create([
            'key' => 'facebook',
            'value' => 'facebook',
        ]);

        app(Config::class)->create([
            'key' => 'youtube',
            'value' => 'youtube',
        ]);

        app(Config::class)->create([
            'key' => 'email',
            'value' => 'email@email.com',
        ]);

        app(Config::class)->create([
            'key' => 'phone',
            'value' => '0974 xxx xxx',
        ]);

        app(Config::class)->create([
            'key' => 'address',
            'value' => 'address',
        ]);

        app(Config::class)->create([
            'key' => 'logo',
            'value' => '',
        ]);

        app(Config::class)->create([
            'key' => 'slogan',
            'value' => "if you don't program yourself, life will program you",
        ]);
        
        app(Config::class)->create([
            'key' => 'introduce',
            'value' => '',
        ]);
    }
}
