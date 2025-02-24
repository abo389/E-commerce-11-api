<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Load the JSON data
        $jsonData = file_get_contents(__DIR__.'/data/category.json');
        $data = json_decode($jsonData, true);

        $image_prefix = 'https://abo389.github.io/image-server/images/categories/';

        // Loop through each category
        foreach ($data['categories'] as $categoryData) {
            // Create the category
            $category = Category::create(['name' => $categoryData['name']]);

            // Loop through each subcategory
            foreach ($categoryData['subcategories'] as $subCategoryData) {
                // Create the subcategory
                SubCategory::create([
                    'category_id' => $category->id,
                    'name' => $subCategoryData['name'],
                    'image' => $image_prefix . $subCategoryData['image']
                ]);
            }
        }
    }
}
