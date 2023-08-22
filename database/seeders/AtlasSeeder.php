<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AtlasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert countries into the database
        $this->command->info('Seeding countries...');
        $countries_sql = file_get_contents(database_path('dump/countries.sql'));
        DB::unprepared($countries_sql);
        $this->command->info('Seeding countries completed.');

        // Insert timezones into the database
        $this->command->info('Seeding timezones...');
        $timezones_sql = file_get_contents(database_path('dump/timezones.sql'));
        DB::unprepared($timezones_sql);
        $this->command->info('Seeding timezones completed.');

        // Insert states into the database
        $this->command->info('Seeding states...');
        $states_sql = file_get_contents(database_path('dump/states.sql'));
        DB::unprepared($states_sql);
        $this->command->info('Seeding states completed.');

        // Insert cities into the database
        $this->command->info('Seeding cities...');
        $cities_sql = file_get_contents(database_path('dump/cities.sql'));
        DB::unprepared($cities_sql);
        $this->command->info('Seeding cities completed.');
    }
}
