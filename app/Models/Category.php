<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = [
        'name', 'parent_id', 'icon', 'slug',
    ];
    protected $hidden = ['created_at', 'updated_at'];
    // If you want to define a relationship where a category can have many child categories
    public function subCategories(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Category::class, "parent_id",'id');
    }

    // If you want to define a relationship to the parent category
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    public function deleteChildren(): void{
        foreach ($this->subCategories as $child){
            $child->deleteChildren();
            $child->delete();
        }
    }

    public function getCategoriesWithSub(){
        return Category::where('parent_id','=',null)->with('subCategories')->get();
    }
    public static function boot(): void
    {
        // Trước khi xóa 1 category sẽ xóa các category con
        parent::boot();
        static::deleting(function($category){
            $category->deleteChildren();
        });
    }
}

