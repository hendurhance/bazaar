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
        $categories =  [
            'Electronics' => [
                'Mobile Phones',
                'Laptops',
                'Cameras',
                'Audio & Video',
            ],
            'Fashion' => [
                'Clothing',
                'Shoes',
                'Accessories',
            ],
            'Home & Garden' => [
                'Furniture',
                'Appliances',
                'Decor',
            ],
            'Vehicles' => [
                'Cars',
                'Motorcycles',
                'Boats',
            ],
            'Collectibles' => [
                'Coins',
                'Stamps',
                'Art',
            ],
            'Sporting Goods' => [
                'Exercise & Fitness',
                'Golf',
            ],
            'Toys & Hobbies' => [
                'Toys',
                'Games',
                'Hobbies',
            ],
            'Business & Industrial' => [
                'Agriculture & Forestry',
                'Construction',
                'Electrical',
            ],
            'Music' => [
                'Records',
                'CDs',
                'Instruments',
            ],
            'Other' => [
                'Miscellaneous',
            ],
        ];

        foreach ($categories as $parent => $children) {
            $parentCategory = Category::factory()->create([
                'name' => $parent,
            ]);

            foreach ($children as $child) {
                Category::factory()->create([
                    'parent_id' => $parentCategory->id,
                    'name' => $child,
                ]);
            }
        }
    }
}
