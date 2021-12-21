<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PermissionSelf
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->route('user');

        if ($user != auth()->user()) {
            $message = "User " . auth()->user()->name . " tried to change profile " .  $user->email . " in their own personal settings.";
            Log::warning($message);
            abort(403);
        }

        return $next($request);
    }
}
