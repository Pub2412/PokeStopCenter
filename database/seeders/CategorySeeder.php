<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Trading Cards',
            'description' => 'Pokemon trading card sets and booster packs',
        ]);

        Category::create([
            'name' => 'Plushies',
            'description' => 'Soft Pokemon plush toys and stuffed animals',
        ]);

        Category::create([
            'name' => 'Figures',
            'description' => 'Pokemon action figures and collectible statues',
        ]);

        Category::create([
            'name' => 'Apparel',
            'description' => 'Pokemon clothing, hats, and accessories',
        ]);

        Category::create([
            'name' => 'Games',
            'description' => 'Pokemon video games and board games',
        ]);

        Category::create([
            'name' => 'Home & Decor',
            'description' => 'Pokemon home decoration items and posters',
        ]);
    }
}

