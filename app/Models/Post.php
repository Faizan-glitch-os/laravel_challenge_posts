<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasUlids, SoftDeletes;

    protected $fillable = ['title', 'content', 'is_published', 'published_at'];
}
