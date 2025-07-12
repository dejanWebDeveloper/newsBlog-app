<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleComment extends Model
{
    protected $table = 'article_comments';
    protected $fillable = ['name', 'email', 'comment', 'article_id', 'allowed', 'created_at'];
}
