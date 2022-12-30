<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminAuth
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
        //check user is admin then redirect to admin dashboard
        if (auth()->user()->is_admin == '1' && Str::contains($request->url(), 'admin') == true) {
            return $next($request);
        } else if (auth()->user()->is_admin == '1' && Str::contains($request->url(), 'admin') == false) { //check admin user then redirect to admin dashboard
            return redirect('/admin/dashboard');
        } else if (auth()->user()->is_admin == '0' && Str::contains($request->url(), 'admin') == true) { //check user then redirect to user dashboard
            return redirect('/dashboard');
        } else {
            return $next($request);
        }
    }
}