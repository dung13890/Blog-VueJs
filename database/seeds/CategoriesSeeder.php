<?php

use Illuminate\Database\Seeder;
use App\Eloquent\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app(Category::class)->create([
            'name' => trans('repositores.categories.first'),
            'type' => 'post',
        ]);
        if (App::environment('local')) {
            $categories = factory(Category::class, 10)->create();

            $postCategories = app(Category::class)->where('type', 'post')->where('parent_id',0)->get();
            factory(Category::class, 20)->create()->each(function ($category) use ($postCategories) {
                if ($category->type == 'post') {
                    $category->update(['parent_id' => $postCategories->pluck('id')->random()]);
                }
            });
        }
    }
}
