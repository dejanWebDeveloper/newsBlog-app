<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'description',
        'show_on_homepage',
        'priority',
        'created_at'
    ];
    public function articles()
    {
        return $this->hasMany(Article::class, 'category_id', 'id');
    }
}
