<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table='posts';
    protected $fillable = [
        'title', 'slug', 'description', 'content', 'images',
        'seo_title', 'seo_keywords', 'seo_description'
    ];

    // Optionally, if you plan to store images as JSON or serialized array, you can cast them:
    protected $casts = [
        'images' => 'array', // or 'json' if you are using JSON format for images
    ];
}
