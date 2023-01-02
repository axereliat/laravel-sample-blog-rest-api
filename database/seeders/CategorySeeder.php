<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Sports',
                'position' => 1
            ],
            [
                'name' => 'Comedy',
                'position' => 2
            ],
            [
                'name' => 'News',
                'position' => 3
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
