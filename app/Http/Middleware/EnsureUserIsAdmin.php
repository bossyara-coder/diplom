<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    public function handle(Request $request, Closure $next){
        / проверяем, авторизован ли пользователь и является ли он администратором
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // если пользователь не администратор, перенаправляем его с сообщением об ошибке
        return redirect('/')->with('error', 'У вас нет доступа к этой странице.');
    }
}
