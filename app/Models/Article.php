<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'blog.articles';
    protected $fillable = ['title', 'author', 'content'];
}
