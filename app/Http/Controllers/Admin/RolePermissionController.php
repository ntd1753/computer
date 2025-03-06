<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\RoleRequest;
use App\Models\Admin;
use App\Models\CustomPermission;
use App\Models\CustomRole;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Libs\CommonLib;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class RolePermissionController extends Controller
{
    /**
     * Role management page
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('content.role.index');
    }

    /**
     *
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function search(Request $request)
    {
        $post = CommonLib::convertDataTableParam($request->all());
        $query = CustomRole::roleName($post->role_name ?? '');
//        dd(CustomPermission::getValidPermissions());

        return DataTables::of($query)
            ->escapeColumns([])
            ->addIndexColumn()
            ->editColumn('code', function ($data) {
                return $data->code ?? '';
            })
            ->editColumn('name', function ($data) {
                return $data->name ?? '';
            })
            ->editColumn('is_active', function ($data) {
                $class = $data->is_active == CustomRole::Active ? 'success' : 'danger';
                return '<label class="badge bg-' . $class . '">' . ($data->is_active == CustomRole::Active ? __('Active') : __('Inactive')) . '</label>';
            })
            ->editColumn('action', function ($data) {
                $show = in_array(CustomPermission::getPermissionByKey('AssignRole'), CustomPermission::getValidPermissions())
                    ? '<a class="text-orange permission-button" href="#" data-bs-toggle="modal" data-bs-target="#permissionModal" data-id="' . $data->id . '"><i class="fas fa-user-lock"></i></a>'
                    : '';

                $edit = in_array(CustomPermission::getPermissionByKey('EditARole'), CustomPermission::getValidPermissions())
                    ? '<a class="text-orange edit-button" href="#" data-id="' . $data->id . '" data-code="' . $data->code . '" data-name="' . $data->name . '" data-is_active="' . $data->is_active . '" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fas fa-edit"></i></a>'
                    : '';
                return $show . '&nbsp;&nbsp;' . $edit;

            })
            ->make(true);
    }

    /**
     * Store role
     *
     * @param RoleRequest $request
     * @return JsonResponse
     */
    public function store(RoleRequest $request)
    {
        $data = $request->all();
        $role = CustomRole::create($data);


        if (!$role) {
            return response()->json(['success' => false, 'message' => __('label.create_not_success')]);
        }

        return response()->json(['success' => true, 'message' => __('label.create_success')]);

    }

    /**
     * Update role
     *
     * @param RoleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(RoleRequest $request)
    {
        $data = $request->all();
        $role = CustomRole::findOrFail($data['id']);
        $data['is_active'] = $data['is_active'] ?? false;
        $role->update($data);
        if(!$data['is_active']){
            $this->deActive($request);
        }
        if (!$role) {
            return response()->json(['success' => false, 'message' => __('label.update_not_success')]);
        }

        return response()->json(['success' => true, 'message' => __('label.update_success')]);

    }

    public function getListPermission(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        //get list permission where role id = param_request
        $permissions = CustomPermission::with([
            'roles' => function ($query) use ($id) {
                $query->where('roles.id', $id);
            }
        ])->get();

        //check relation with role has permission (if role_has_permission have role and permission set true and dont have record set false )
        foreach ($permissions as $permission) {
            $permission->check_permission = $permission->roles->isNotEmpty();
        }

        $handlePermissions = json_decode(json_encode($permissions), true);
        $recursiveTree = self::buildRecursiveTree($handlePermissions);
        return response()->json($recursiveTree);
    }

    // use recursive tree to build hierarchy
    function buildRecursiveTree($items, $systemNameParent = null)
    {
        $tree = [];
        foreach ($items as $item) {
            if ($item['system_name_parent'] === $systemNameParent) {
                $children = self::buildRecursiveTree($items, $item['system_name']);
                if ($children) {
                    $item['children'] = $children;
                }
                $tree[] = $item;
            }
        }
        return $tree;
    }

    // asssign permissions for role
    function assignPermission(Request $request)
    {
        $data = $request->all();
        try {
            $role = CustomRole::findOrFail($data['id']);
            $role->permissions()->detach();
            if (isset($data['permission_lists'])) {
                $role->permissions()->attach($data['permission_lists']);
                Artisan::call('cache:clear');
            }
            return response()->json(['success' => true, 'message' => __('label.update_success')]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => __('label.update_not_success')]);
        }

    }

    public function deActive(RoleRequest $request){
        // delete role_has_permissions
        $data = $request->all();
        $role = CustomRole::findOrFail($data['id']);
        $role->permissions()->detach();
        Artisan::call('cache:clear');
        // Deactivate users with the specified role
        $users = User::where("role_id", $data["id"])->get(); // Retrieve the users
        foreach ($users as $user) {
            $user->status = Admin::STATUS_INACTIVE;
            $user->save(); // Save each user's updated status
        }
    }
}
