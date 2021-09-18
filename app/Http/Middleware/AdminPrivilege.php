<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminPrivilege
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
        if (auth()->guest()) {
            $message = "A guest attempted to access a forbidden view.";
            Log::warning($message);
            abort(403);
        } else if (auth()->user()->privilege->title !== 'Admin') {
            $message = "User " . auth()->user()->name . " attempted to access a forbidden view.";
            Log::warning($message);
            abort(403);
        }

        return $next($request);
    }
}
