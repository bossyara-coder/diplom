<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
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
        // Проверяем: залогинен ли юзер И является ли он админом
        if (auth()->check() && auth()->user()->is_admin == 1) {
            return $next($request); // Пропускаем дальше
        }

        // Если нет — отправляем на главную с ошибкой
        return redirect('/')->with('error', 'У вас нет прав доступа к этой странице.');
    }
}
