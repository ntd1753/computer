<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasFactory, HasRoles, softDeletes;

    protected $table = 'admins';
    protected $fillable = [
        'name', 'password', 'remember_token', 'email', 'status', 'email_verified_at', 'role_id', 'avatar'
    ];
    CONST STATUS_ACTIVE = 1;
    CONST STATUS_INACTIVE =  99;
    public static  $listStatus = [
        self::STATUS_ACTIVE => 'Active',
        self::STATUS_INACTIVE => 'Inactive'
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function role(){
        return $this->belongsTo(CustomRole::class,'role_id');
    }
    public function scopeName($query, $filter)
    {
        return !empty($filter) ? $query->where('name', 'like', '%' . $filter . '%') : $query;
    }
    public function scopeEmail($query, $filter)
    {
        return !empty($filter) ? $query->where('email', 'like', '%' . $filter . '%') : $query;
    }
    public function scopeStatus($query, $filter)
    {
        return !empty($filter) ? $query->where('status', $filter) : $query;
    }
    public function scopeRole($query, $filter)
    {
        return !empty($filter) ? $query->whereHas('role', function($q) use ($filter) {
            $q->where('role_id', $filter); // Giả sử bạn muốn lọc theo tên vai trò
        }) : $query;
    }
}
