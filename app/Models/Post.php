<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    public static function fillDataPost($input,$post){
        $post->title = $input['title'] ?? '';
        $post->slug = Str::slug($input['title']?? '');
        $post->description = $input['description'] ?? "";
        $post->content = $input['content'];
        $post->images = $input['images']??'';
        $post->seo_title = $input['seo_title'];
        $post->seo_keywords = $input['seo_keywords'];
        $post->seo_description = $input['seo_description'];
        $post->save();
        return $post;
    }
}
