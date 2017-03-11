<?php

use Illuminate\Database\Seeder;
use App\Eloquent\User;

class AbilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $abilities = array(
            'role-read', 'role-write',
            'user-read', 'user-write',
            'category-read', 'category-write',
            'post-read', 'post-write',
            'page-read', 'page-write',
            'menu-read', 'menu-write',
            'config-read', 'config-write',
            'slide-read', 'slide-write',
        );

        foreach ($abilities as $ability) {
            Bouncer::ability(['name' => $ability])->save();
        }
        Bouncer::allow('system')->to($abilities);
        Bouncer::allow('admin')->to($abilities);
        User::find(1)->assign('system');
        User::find(2)->assign('admin');
    }
}
