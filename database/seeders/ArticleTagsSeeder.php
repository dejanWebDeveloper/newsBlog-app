<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('article_tags')->truncate();
        $articlesIds = Article::all()->pluck('id')->toArray();
        $tagsIds = Tag::all()->pluck('id')->toArray();

        foreach ($articlesIds as $articleId) {
            DB::table('article_tags')->insert([
                'article_id' => $articleId,
                'tag_id' => $tagsIds[array_rand($tagsIds)],
                'created_at' => now()
            ]);
            DB::table('article_tags')->insert([
                'article_id' => $articleId,
                'tag_id' => $tagsIds[array_rand($tagsIds)],
                'created_at' => now()
            ]);
            DB::table('article_tags')->insert([
                'article_id' => $articleId,
                'tag_id' => $tagsIds[array_rand($tagsIds)],
                'created_at' => now()
            ]);
        }
    }
}
