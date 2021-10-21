<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PermissionCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $permission)
    {
        $permissionTranslation = config('privileges.privilege_map');

        $userPermission = $permissionTranslation[strtoupper(auth()->user()->privilege->title)];
        $permission = $permissionTranslation[strtoupper($permission)];

        if (auth()->guest()) {
                $message = "A guest attempted to access a forbidden view.";
                Log::warning($message);
                abort(403);
        } else if ($userPermission < $permission) {
                $message = "User " . auth()->user()->name . " with " .  auth()->user()->privilege->title . " permission attempted to access a forbidden view.";
                Log::warning($message);
                abort(403);
        }

        return $next($request);
    }
}
