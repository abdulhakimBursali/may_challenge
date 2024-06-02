<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();

        $categories = [
            [
                'name' => 'Kategori 1',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Kategori 2',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        Category::insert($categories);
    }
}
