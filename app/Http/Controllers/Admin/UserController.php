<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\AddUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Models\Admin;
use App\Models\CustomRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->get('name');
        $email = $request->get('email');
        $status = $request->get('status');
        $role = $request->get('role');
        $listRole = CustomRole::status(CustomRole::Active)->pluck('name', 'id')->toArray();
        $admins = Admin::where('id', '!=', auth()->id())
            ->name($name)
            ->email($email)
            ->status($status)
            ->role($role)
            ->paginate(10);
        return view('content.user.index', [
            'admins' => $admins,
            'listRole' => $listRole,
        ]);
    }
    public function add()
    {
        if (in_array(\App\Models\CustomPermission::getPermissionByKey('UserRoleAndPermissionList'), \App\Models\CustomPermission::getValidPermissions())){
            $listRole = CustomRole::status(CustomRole::Active)->pluck('name', 'id')->toArray();
        }else{
            $listRole = CustomRole::status(CustomRole::Active)->where('code', '!=', CustomRole::SPADMIN)->pluck('name', 'id')->toArray();
        }

        return view('content.user.add', [
            'listRole' => $listRole
        ]);
    }
    public function store(AddUserRequest $request)
    {

        $data = $request->all();
        Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $data['role_id'],
            'status' => $data['status'],
            'avatar' => $data['avatar'],
        ]);
        return response()->json(['success' => true, 'message' => __('create success'),
            'url' => route('user.index')]);
    }
    public function edit($id)
    {
        $admin = Admin::find($id);
        if (in_array(\App\Models\CustomPermission::getPermissionByKey('UserRoleAndPermissionList'), \App\Models\CustomPermission::getValidPermissions())){
            $listRole = CustomRole::status(CustomRole::Active)->pluck('name', 'id')->toArray();
        }else{
            $listRole = CustomRole::status(CustomRole::Active)->where('code', '!=', CustomRole::SPADMIN)->pluck('name', 'id')->toArray();
        }

        return view('content.user.edit', [
            'admin' => $admin,
            'listRole' => $listRole
        ]);
    }
    public function update(UpdateUserRequest $request, $id)
    {
        $admin = Admin::find($id);
        $data = $request->all();
        $admin->update([
            'name' => $data['name'],
            'role_id' => $data['role_id'],
            'status' => $data['status'],
            'avatar' => $data['avatar'],
        ]);
        return response()->json(['success' => true, 'message' => __('update success'),
            'url' => route('user.index')]);
    }
}
