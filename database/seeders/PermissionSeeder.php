<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'system_name' => 'Dashboard',
                'name' => 'Bảng điều khiển',
                'system_name_parent' => null,
                'guard_name' => 'admin',
            ],
            // Quản lí người dùng - UserManagement
            [
                'system_name' => 'UserManagement',
                'name' => 'Quản lí người dùng',
                'system_name_parent' => null,
                'guard_name' => 'admin',
            ],
            [
                'system_name' => 'AddAnUser',
                'name' => 'Thêm người dùng',
                'system_name_parent' => 'UserManagement',
                'guard_name' => 'admin',
            ],
            [
                'system_name' => 'EditAnUser',
                'name' => 'Chỉnh sửa người dùng',
                'system_name_parent' => 'UserManagement',
                'guard_name' => 'admin',
            ],
            [
                'system_name' => 'DeleteAnUser',
                'name' => 'Xóa người dùng',
                'system_name_parent' => 'UserManagement',
                'guard_name' => 'admin',
            ],
            [
                'system_name' => 'ChangePassword',
                'name' => 'Đổi mật khẩu',
                'system_name_parent' => 'UserManagement',
                'guard_name' => 'admin',
            ],
            // Quản lí quyền và vai trò - UserRoleAndPermission
            [
                'system_name' => 'UserRoleAndPermissionList',
                'name' => 'Danh sách quyền và vai trò',
                'system_name_parent' => null,
                'guard_name' => 'admin',
            ],
            [
                'system_name' => 'AddARole',
                'name' => 'Thêm vai trò',
                'system_name_parent' => 'UserRoleAndPermissionList',
                'guard_name' => 'admin',
            ],
            [
                'system_name' => 'EditARole',
                'name' => 'Chỉnh sửa vai trò',
                'system_name_parent' => 'UserRoleAndPermissionList',
                'guard_name' => 'admin',
            ],
            [
                'system_name' => 'AssignRole',
                'name' => 'Gán vai trò',
                'system_name_parent' => 'UserRoleAndPermissionList',
                'guard_name' => 'admin',
            ],
            // Quản lí khach hàng - CustomerManagement
            [
                'system_name' => 'CustomerManagement',
                'name' => 'Quản lí khách hàng',
                'system_name_parent' => null,
                'guard_name' => 'admin',
            ],
            [
                'system_name' => 'EditACustomer',
                'name' => 'Chỉnh sửa khách hàng',
                'system_name_parent' => 'CustomerManagement',
                'guard_name' => 'admin',
            ],
            [
                'system_name' => 'DeleteACustomer',
                'name' => 'Xóa khách hàng',
                'system_name_parent' => 'CustomerManagement',
                'guard_name' => 'admin',
            ],
            [
                'system_name' => 'AddACustomer',
                'name' => 'Thêm khách hàng',
                'system_name_parent' => 'CustomerManagement',
                'guard_name' => 'admin',
            ],
            // Quản lí sản phẩm - ProductManagement
            [
                'system_name' => 'ProductManagement',
                'name' => 'Quản lí sản phẩm',
                'system_name_parent' => null,
                'guard_name' => 'admin',
            ],
            [
                'system_name' => 'AddAProduct',
                'name' => 'Thêm sản phẩm',
                'system_name_parent' => 'ProductManagement',
                'guard_name' => 'admin',
            ],
            [
                'system_name' => 'EditAProduct',
                'name' => 'Chỉnh sửa sản phẩm',
                'system_name_parent' => 'ProductManagement',
                'guard_name' => 'admin',
            ],
            [
                'system_name' => 'DeleteAProduct',
                'name' => 'Xóa sản phẩm',
                'system_name_parent' => 'ProductManagement',
                'guard_name' => 'admin',
            ],
            // Quản lí danh mục - CategoryManagement
            [
                'system_name' => 'CategoryManagement',
                'name' => 'Quản lí danh mục',
                'system_name_parent' => null,
                'guard_name' => 'admin',
            ],
            [
                'system_name' => 'AddACategory',
                'name' => 'Thêm danh mục',
                'system_name_parent' => 'CategoryManagement',
                'guard_name' => 'admin',
            ],
            [
                'system_name' => 'EditACategory',
                'name' => 'Chỉnh sửa danh mục',
                'system_name_parent' => 'CategoryManagement',
                'guard_name' => 'admin',
            ],
            [
                'system_name' => 'DeleteACategory',
                'name' => 'Xóa danh mục',
                'system_name_parent' => 'CategoryManagement',
                'guard_name' => 'admin',
            ],
            // Quản lí thương hiệu - BrandManagement
            [
                'system_name' => 'BrandManagement',
                'name' => 'Quản lí thương hiệu',
                'system_name_parent' => null,
                'guard_name' => 'admin',
            ],
            [
                'system_name' => 'AddABrand',
                'name' => 'Thêm thương hiệu',
                'system_name_parent' => 'BrandManagement',
                'guard_name' => 'admin',
            ],
            [
                'system_name' => 'EditABrand',
                'name' => 'Chỉnh sửa thương hiệu',
                'system_name_parent' => 'BrandManagement',
                'guard_name' => 'admin',
            ],
            [
                'system_name' => 'DeleteABrand',
                'name' => 'Xóa thương hiệu',
                'system_name_parent' => 'BrandManagement',
                'guard_name' => 'admin',
            ],
            // Quản lí bài viết - PostManagement
            [
                'system_name' => 'PostManagement',
                'name' => 'Quản lí bài viết',
                'system_name_parent' => null,
                'guard_name' => 'admin',
            ],
            [
                'system_name' => 'AddAPost',
                'name' => 'Thêm bài viết',
                'system_name_parent' => 'PostManagement',
                'guard_name' => 'admin',
            ],
            [
                'system_name' => 'EditAPost',
                'name' => 'Chỉnh sửa bài viết',
                'system_name_parent' => 'PostManagement',
                'guard_name' => 'admin',
            ],
            [
                'system_name' => 'DeleteAPost',
                'name' => 'Xóa bài viết',
                'system_name_parent' => 'PostManagement',
                'guard_name' => 'admin',
            ],

            //Quản lí đơn hàng - OrderManagement
            [
                'system_name' => 'OrderManagement',
                'name' => 'Quản lí đơn hàng',
                'system_name_parent' => null,
                'guard_name' => 'admin',
            ],
            [
                'system_name' => 'EditAnOrder',
                'name' => 'Chỉnh sửa đơn hàng',
                'system_name_parent' => 'OrderManagement',
                'guard_name' => 'admin',
            ],
            [
                'system_name' => 'DeleteAnOrder',
                'name' => 'Xóa đơn hàng',
                'system_name_parent' => 'OrderManagement',
                'guard_name' => 'admin',
            ],
            [
                'system_name' => 'AddAnOrder',
                'name' => 'Thêm đơn hàng',
                'system_name_parent' => 'OrderManagement',
                'guard_name' => 'admin',
            ],
            // Quản lí cài đặt - Setting
            [
                'system_name' => 'Setting',
                'name' => 'Cài đặt',
                'system_name_parent' => null,
                'guard_name' => 'admin',
            ],
            [
                'system_name' => 'GeneralSetting',
                'name' => 'Cài đặt chung',
                'system_name_parent' => 'Setting',
                'guard_name' => 'admin',
            ],
            [
                'system_name' => 'ShippingSetting',
                'name' => 'Cài đặt vận chuyển',
                'system_name_parent' => 'Setting',
                'guard_name' => 'admin',
            ],
            // Quản lí thông báo - NotificationSetting
            [
                'system_name' => 'NotificationSetting',
                'name' => 'Cài đặt thông báo',
                'system_name_parent' => 'Setting',
                'guard_name' => 'admin',
            ],
            [
                'system_name' => 'EditNotificationSetting',
                'name' => 'Chỉnh sửa cài đặt thông báo',
                'system_name_parent' => 'Setting',
                'guard_name' => 'admin',
                ],
            // Quản lí banner - BannerManagement
            [
                'system_name' => 'BannerManagement',
                'name' => 'Quản lí banner',
                'system_name_parent' => null,
                'guard_name' => 'admin',
            ],
            [
                'system_name' => 'AddABanner',
                'name' => 'Thêm banner',
                'system_name_parent' => 'BannerManagement',
                'guard_name' => 'admin',
            ],
            [
                'system_name' => 'EditABanner',
                'name' => 'Chỉnh sửa banner',
                'system_name_parent' => 'BannerManagement',
                'guard_name' => 'admin',
            ],
            [
                'system_name' => 'DeleteABanner',
                'name' => 'Xóa banner',
                'system_name_parent' => 'BannerManagement',
                'guard_name' => 'admin',
            ],
            // Quản lí đánh giá và bình luận sản phẩm
            [
                'system_name' => 'ReviewManagement',
                'name' => 'Quản lí đánh giá và bình luận sản phẩm',
                'system_name_parent' => null,
                'guard_name' => 'admin',
            ],
            [
                'system_name' => 'EditAReview',
                'name' => 'Chỉnh sửa đánh giá',
                'system_name_parent' => 'ReviewManagement',
                'guard_name' => 'admin',
            ],
            [
                'system_name' => 'DeleteAReview',
                'name' => 'Xóa đánh giá',
                'system_name_parent' => 'ReviewManagement',
                'guard_name' => 'admin',
            ],
            //Quản lí bộ lọc
            [
                'system_name' => 'FilterManagement',
                'name' => 'Quản lí bộ lọc',
                'system_name_parent' => null,
                'guard_name' => 'admin',
            ],
            [
                'system_name' => 'EditFilter',
                'name' => 'Chỉnh sửa bộ lọc',
                'system_name_parent' => 'FilterManagement',
                'guard_name' => 'admin',
            ],
        ];
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('role_has_permissions')->truncate();
        DB::table('permissions')->truncate();
        DB::table('roles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('permissions')->insert($data);

        $roles = [
            ['code' => 'SPADMIN', 'name' => 'SuperAdmin', 'guard_name' => 'admin', 'is_active' => 1],
            ['code' => 'STAFF', 'name' => 'Nhân viên', 'guard_name' => 'admin', 'is_active' => 1],
            ['code' => 'BLOGGER', 'name' => 'Blogger', 'guard_name' => 'admin', 'is_active' => 1],

        ];
        DB::table('roles')->insert($roles);


        //seeding data into role_has_permission
        $superAdmin = DB::table('roles')->where('code', 'SPADMIN')->first();
        $permissions = DB::table('permissions')->get();
        $rolePermissions = [];
        foreach ($permissions as $permission) {
            $rolePermissions[] = [
                'permission_id' => $permission->id,
                'role_id' => $superAdmin->id,
            ];
        }
        //insert permission staff into role_has_permissions table
        DB::table('role_has_permissions')->insert($rolePermissions);
        $staff = DB::table('roles')->where('code', 'STAFF')->first();
        $ProductManagement = DB::table('permissions')->where('system_name', 'ProductManagement')->get();
        $BrandManagement = DB::table('permissions')->where('system_name', 'BrandManagement')->get();
        $CategoryManagement = DB::table('permissions')->where('system_name', 'CategoryManagement')->get();
        $OrderManagement = DB::table('permissions')->where('system_name', 'OrderManagement')->get();
        $Setting = DB::table('permissions')->where('system_name', 'Setting')->get();
        $staffPermissions = $ProductManagement->merge($BrandManagement)->merge($CategoryManagement)->merge($OrderManagement)->merge($Setting);
        $rolePermissions = [];
        foreach ($staffPermissions as $permission) {
                $rolePermissions[] = [
                    'permission_id' => $permission->id,
                    'role_id' => $staff->id,
                ];
        }
        DB::table('role_has_permissions')->insert($rolePermissions);
        //Blogger role has permission to manage post
        $blogger = DB::table('roles')->where('code', 'BLOGGER')->first();
        $PostManagement = DB::table('permissions')->where('system_name', 'PostManagement')->get();
        $bloggerPermissions = $PostManagement;
        $rolePermissions = [];
        foreach ($bloggerPermissions as $permission) {
            $rolePermissions[] = [
                'permission_id' => $permission->id,
                'role_id' => $blogger->id,
            ];
        }
        DB::table('role_has_permissions')->insert($rolePermissions);
    }
}
