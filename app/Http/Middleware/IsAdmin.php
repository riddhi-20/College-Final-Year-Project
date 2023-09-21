<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->is_admin == 0) {
            return redirect()->route('userhome');
        }

        if (Auth::user()->is_admin == 1) {
            return $next($request);
        }

        else {
            return back()->with('error',"You don't have access."); // Redirecting same dashboard when user try to access another dashboard by typing in the URL
        }


    }
}
