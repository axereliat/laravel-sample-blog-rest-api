<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        Article::factory(100)->create();

        $categories = Category::all();

        foreach (Article::all() as $article) {
            $randomIndex = rand(0, $categories->count() - 1);
            $selectedCategory = $categories[$randomIndex];
            $article->categories()->attach($selectedCategory->id);
        }
    }
}
