<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieRole;

class CustomRole extends SpatieRole
{
    use HasFactory;
    protected $table = 'roles';
    protected $fillable = ['name', 'guard_name', 'is_active', 'code'];


    //List role
    const SPADMIN = 'SPADMIN';
    const STAFF = 'STAFF';
    const BLOGGER ='BLOGGER';
    const SERVICECUSTOMER = 'SERVICECUSTOMER';

    //List role can see all file manager
    public static $listRoleFile = [
        self::SPADMIN => 'SPADMIN',
        self::STAFF => 'STAFF',
        self::BLOGGER => 'BLOGGER',
        self::SERVICECUSTOMER => 'SERVICE CUSTOMER',

    ];
    //list status
    const Active = 1;
    const Inactive = 99;

    /**
     * Filter by role_name
     *
     * @param $query
     * @param $filter
     * @return mixed
     */
    public function scopeRoleName($query, $filter)
    {
        return !empty($filter) ? $query->where('name', 'like', "%{$filter}%") : $query;
    }
    public function scopeStatus($query, $filter)
    {
        return !empty($filter) ? $query->where('is_active', $filter) : $query;
    }
}
