<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'author', 'id');
    }
    public function tag()
    {
        return $this->belongsToMany(Tag::class, 'article_tags', 'article_id', 'tag_id');
    }
    public function scopeCategoryNews($query)
    {
        $query->with('category')
            ->where('ban', 0);
    }
    public function getImageUrl()
    {
        return url('themes/front/images/img_2_horizontal.jpg');
    }
}
