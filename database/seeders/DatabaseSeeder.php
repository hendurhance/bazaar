<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            CategorySeeder::class,
            AtlasSeeder::class,
            UserSeeder::class,
            AdSeeder::class,
            TagSeeder::class,
            PostSeeder::class,
            SupportSeeder::class,
            PayoutSeeder::class,
        ]);
    }
}
