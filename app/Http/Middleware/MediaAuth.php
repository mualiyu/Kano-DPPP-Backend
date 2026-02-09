<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MediaAuth
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
        if (session()->has('media_user')) {
            return $next($request);
        }
        return redirect()->route('m_show_login');
        // return $next($request);
    }
}
