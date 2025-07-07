<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\CustomRole;
use Illuminate\Http\Request;

class CustomerController extends Controller
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
}
