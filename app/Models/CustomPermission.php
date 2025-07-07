<?php

namespace App\Models;

use Auth;
use Cache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission as SpatiePermission;

class CustomPermission extends SpatiePermission
{
    use HasFactory;
    protected $fillable = ['system_name','name', 'guard_name'];

    //list permission OTA system
    protected static $listPermissions = [
        'Dashboard' => 'Dashboard',
        'Admin' => 'Admin',
        'UserManagement' => 'UserManagement',
        'AddAnUser' => 'AddAnUser',
        'EditAnUser' => 'EditAnUser',
        'DeleteAnUser' => 'DeleteAnUser',
        'ChangePassword' => 'ChangePassword',
        'UserRoleAndPermissionList' => 'UserRoleAndPermissionList',
        'AddARole' => 'AddARole',
        'EditARole' => 'EditARole',
        'AssignRole' => 'AssignRole',
        'CustomerManagement' => 'CustomerManagement',
        'EditACustomer' => 'EditACustomer',
        'DeleteACustomer' => 'DeleteACustomer',
        'AddACustomer' => 'AddACustomer',
        'ProductManagement' => 'ProductManagement',
        'AddAProduct' => 'AddAProduct',
        'EditAProduct' => 'EditAProduct',
        'DeleteAProduct' => 'DeleteAProduct',
        'OrderManagement' => 'OrderManagement',
        'AddAnOrder' => 'AddAnOrder',
        'EditAnOrder' => 'EditAnOrder',
        'DeleteAnOrder' => 'DeleteAnOrder',
        'ReportManagement' => 'ReportManagement',
        'ViewReport' => 'ViewReport',
        'Setting' => 'Setting',
        'EditSetting' => 'EditSetting',
        'Notification' => 'Notification',
        'ViewNotification' => 'ViewNotification',
        'AddNotification' => 'AddNotification',
        'EditNotification' => 'EditNotification',
        'DeleteNotification' => 'DeleteNotification',
        'PostManagement' => 'PostManagement',
        'AddAPost' => 'AddAPost',
        'EditAPost' => 'EditAPost',
        'DeleteAPost' => 'DeleteAPost',
        'CategoryManagement' => 'CategoryManagement',
        'AddACategory' => 'AddACategory',
        'EditACategory' => 'EditACategory',
        'DeleteACategory' => 'DeleteACategory',
        'BrandManagement' => 'BrandManagement',
        'AddABrand' => 'AddABrand',
        'EditABrand' => 'EditABrand',
        'DeleteABrand' => 'DeleteABrand',
        'BannerManagement' => 'BannerManagement',
        'AddABanner' => 'AddABanner',
        'EditABanner' => 'EditABanner',
        'DeleteABanner' => 'DeleteABanner',
        'ReviewManagement' => 'ReviewManagement',
        'EditAReview' => 'EditAReview',
        'FilterManagement' => 'FilterManagement',
        "EditFilter" => 'EditFilter',
    ];

    public function roles(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(CustomRole::class, 'role_has_permissions', 'permission_id', 'role_id');
    }

    // Return the permission associated with the given key, or null if it does not exist.
    public static function getPermissionByKey($key)
    {
        return self::$listPermissions[$key] ?? null;
    }

    // Define a one-to-many relationship with CustomPermission where:
    // - The 'system_name_parent' field matches the current permission's 'system_name'.
    // - The child permissions must also have an associated entry in the role_has_permissions table for the given role ID.
    public function children($roleId)
    {
        return $this->hasMany(CustomPermission::class, 'system_name_parent', 'system_name')
            ->whereHas('roles', function($query) use ($roleId) {
                // Filter the roles to only include those matching the provided role ID.
                $query->where('role_id', $roleId);
            });
    }

    public static function getChildPermissions($permissions, &$validPermission, $roleId)
    {
        $counter = 0;

        foreach ($permissions as $permission) {
            // add current permission into valid permission list
            $validPermission[] = $permission->system_name;
            $permission = CustomPermission::find($permission->id);
            // Check and get child permissions
            if ($permission->children($roleId)->exists()) {
                self::getChildPermissions($permission->children($roleId)->get(), $validPermission, $roleId);
            }
        }
    }

    //get valid permission of role
    public static function getValidPermissions(){
        $roleId = Auth::user()->role_id;
        return Cache::remember('cacheRole_'.$roleId,300, function() use($roleId){
            $role = CustomRole::find($roleId);
            $parentPermissionList = $role->permissions()->where('system_name_parent', null)->get();
            CustomPermission::getChildPermissions($parentPermissionList, $validPermission, $roleId);
            return $validPermission;
        });

    }


}
