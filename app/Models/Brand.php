<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brands';
    protected $fillable =["name","logo"];

    public function scopeName($query, $filter){
        return !empty($filter) ? $query->where('name','like','%'.$filter.'%') : $query;
    }
    public function scopeId($query, $filter){
        return !empty($filter) ? $query->where('id',$filter) : $query;
    }
    public function products(){
        return $this->hasMany(Product::class,'brand_id','id');
    }
    public function deleteImages(){
        if($this->logo){
            if(file_exists(public_path($this->logo))){
                unlink(public_path($this->logo));
            }
        }
    }

}
