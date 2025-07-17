<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        $employee = Employee::all();
        $articles = new Article();
        $articles->truncate();
        $faker = Faker::create();
        for ($i = 0; $i < 200; $i++) {
            $articles->insert([
                'heading' => $faker->lastName,
                'preheading' => $faker->sentence,
                'text' => $faker->text,
                'category_id' => $categories->random()->id,
                'ban' => rand(0, 1),
                'created_at' => now(),
                'author' => $employee->random()->id
            ]);
        }

    }
}
