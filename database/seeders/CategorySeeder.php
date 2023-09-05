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
                'icon' => 'assets/categories/icon/enlargement.svg',
                'bg' => 'assets/categories/bg/electronics.png',
                'subcategories' => [
                    'Mobile Phones',
                    'Laptops',
                    'Cameras',
                    'Audio & Video',
                ],
            ],
            'Fashion' => [
                'icon' => 'assets/categories/icon/fashion.svg',
                'bg' => 'assets/categories/bg/fashion.png',
                'subcategories' => [
                    'Clothing',
                    'Shoes',
                    'Accessories',
                ]
            ],
            'Home & Garden' => [
                'icon' => 'assets/categories/icon/flowers.svg',
                'bg' => 'assets/categories/bg/home-garden.png',
                'subcategories' => [
                    'Furniture',
                    'Appliances',
                    'Decor',
                ],
            ],
            'Vehicles' => [
                'icon' => 'assets/categories/icon/car.svg',
                'bg' => 'assets/categories/bg/vehicles.png',
                'subcategories' => [
                    'Cars',
                    'Motorcycles',
                    'Boats',
                ],
            ],
            'Collectibles' => [
                'icon' => 'assets/categories/icon/data-collection.svg',
                'bg' => 'assets/categories/bg/collectibles.png',
                'subcategories' => [
                    'Coins',
                    'Antiques',
                    'Stamps',
                    'Art',
                ],
            ],
            'Sporting Goods' => [
                'icon' => 'assets/categories/icon/sport.svg',
                'bg' => 'assets/categories/bg/sporting-goods.png',
                'subcategories' => [
                    'Exercise & Fitness',
                    'Golf',
                ],
            ],
            'Toys & Hobbies' => [
                'icon' => 'assets/categories/icon/toys.svg',
                'bg' => 'assets/categories/bg/toys-hobbies.png',
                'subcategories' => [
                    'Action Figures',
                    'Games',
                    'Hobbies',
                ],
            ],
            'Business & Industrial' => [
                'icon' => 'assets/categories/icon/maintenance.svg',
                'bg' => 'assets/categories/bg/business-industrial.png',
                'subcategories' => [
                    'Agriculture & Forestry',
                    'Construction',
                    'Electrical',
                ],
            ],
            'Music' => [
                'icon' => 'assets/categories/icon/tone.svg',
                'bg' => 'assets/categories/bg/music.png',
                'subcategories' => [
                    'Records',
                    'CDs',
                    'Instruments',
                ],
            ],
            'Other' => [
                'icon' => 'assets/categories/icon/application.svg',
                'bg' => 'assets/categories/bg/other.png',
                'subcategories' => [
                    'Miscellaneous',
                ],
            ],
        ];

        foreach ($categories as $parent => $children) {
            $parentCategory = Category::factory()->create([
                'name' => $parent,
                'icon' => $children['icon'],
                'image' => $children['bg'],
            ]);

            foreach ($children['subcategories'] as $child) {
                Category::factory()->create([
                    'parent_id' => $parentCategory->id,
                    'name' => $child,
                ]);
            }
        }
    }
}
