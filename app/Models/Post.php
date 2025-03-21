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



    const TYPE_POST = 'POST';
    const TYPE_PRODUCT = 'PRODUCT';
    public function scopeTitle($query, $filter){
        return !empty($filter) ? $query->where('title','like','%'.$filter.'%') : $query;
    }

    public function scopeAuthorName($query, $filter)
    {
        return !empty($filter) ? $query->whereHas('author', function ($q) use ($filter) {
            $q->where('name', 'like', '%' . $filter . '%');
        }) : $query;
    }

    public function author(){
        return $this->belongsTo(Admin::class,'author_id','id');
    }
    public static function fillDataPost($input,$post, $hasPreviewImages = false){
        $post->title = $input['title'] ?? '';
        $post->slug = Str::slug($input['title']?? '');
        $post->description = $input['description'] ?? "";
        $post->content = $input['content'];
        if ($hasPreviewImages) {
            $post->images = $input['images'] ?? '';
        }
        $post->seo_title = $input['seo_title'];
        $post->seo_keywords = $input['seo_keywords'];
        $post->seo_description = $input['seo_description'];
        $post->save();
        return $post;
    }

    public function deleteImages(){
        if($this->images){
            foreach($this->images as $image){
                if(file_exists(public_path($image))){
                    unlink(public_path($image));
                }
            }
        }
    }

}
