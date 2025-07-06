<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = new Category();

        $categories->truncate();
        $faker = Faker::create();
        for ($i = 0; $i < 15; $i++) {
            $categories->insert([
                'name' => $faker->name,
                'description' => $faker->company,
                'show_on_homepage' => rand(0, 1),
                'priority' => $i+1,
                'created_at' => now()
            ]);
        }
    }
}
