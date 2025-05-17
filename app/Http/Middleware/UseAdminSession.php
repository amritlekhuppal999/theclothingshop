<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;

class UseAdminSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guard=null): Response
    {
        if ($guard === "admin") {
            Config::set(['session.cookie' => 'admin_session']);
        }
        else Config::set(['session.cookie' => Str::slug(env('APP_NAME', 'laravel'), '_').'_session']);

        // Str::slug(env('APP_NAME', 'laravel'), '_').'_session'
        
        return $next($request);
    }
}
