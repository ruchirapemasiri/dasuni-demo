<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRolePermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$permissions): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }


        $section = $permissions[0];
        $action = $permissions[1];

        $action = trim($action);

        $userPermissions = json_decode(auth()->user()->access, true);
        // $routeName = $request->route()->getName();

        if (array_key_exists($section, $userPermissions)) {
            $userActions = $userPermissions[$section];
            $userActions = array_map('trim', $userActions);

            foreach ($userActions as $usrAction) {

                if ($action == $usrAction) {
                    return $next($request);
                }
            }

            return back();
        } else {
            return back();
        };

    }
}
