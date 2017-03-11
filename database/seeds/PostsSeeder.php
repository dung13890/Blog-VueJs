<?php

use Illuminate\Database\Seeder;
use App\Eloquent\Post;
use App\Eloquent\Category;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = app(Category::class)->where('type', 'post');
        factory(Post::class, 20)->create()->each(function($post) use ($categories) {
            $post->categories()->attach($categories->pluck('id')->random(4)->all());
        });
    }
}
