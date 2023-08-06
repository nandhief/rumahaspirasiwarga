<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'image', 'content', 'is_hot'];

    public function getSampleAttribute()
    {
        return \Str::words(strip_tags($this->attibutes['content']), 10, '...');
    }
}
