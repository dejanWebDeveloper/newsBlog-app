<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = new Tag();

        $tags->truncate();
        $faker = Faker::create();
        for ($i = 0; $i < 20; $i++) {
            $tags->insert([
                'name' => $faker->city,
                'created_at' => now()
            ]);
        }
    }
}
