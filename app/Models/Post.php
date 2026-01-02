<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasUlids;

    protected $fillable = ['title', 'content', 'is_published', 'published_at'];
}
