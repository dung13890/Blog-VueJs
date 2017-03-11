<?php

use Illuminate\Database\Seeder;
use App\Eloquent\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 10)->create();

        User::findOrFail(1)->update([
            'name' => 'system',
            'username' => 'system',
            'email' => 'system@daoanhdung.com',
        ]);

        User::findOrFail(2)->update([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@daoanhdung.com',
        ]);
    }
}
