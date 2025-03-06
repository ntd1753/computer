<?php

namespace App\Http\Middleware;

use App\Models\CustomPermission;
use App\Models\CustomRole;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermissionByFunction
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next,$permission): Response
    {
        //get valid permissions to compare
        $validPermission = CustomPermission::getValidPermissions();
        // Check if permission is in valid permissions array
        if ($request->expectsJson()) {
            if (is_array($validPermission) && in_array($permission, $validPermission)) {
                return $next($request);
            } else {
                return response()->json([
                    'message' => __('label.access_denied')
                ], 403);
            }
        } else {

            if (is_array($validPermission) && in_array($permission, $validPermission)) {
                return $next($request);
            } else {
                return redirect()->route('error.permission');
            }
        }
    }

}
