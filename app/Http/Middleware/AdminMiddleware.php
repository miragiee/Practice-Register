<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // dd("ADMIN MIDDLEWARE WORKS");

        $user = Auth::user();

        if (!$user) {
            return redirect()->route("auth");
        }

        if (!$user->role || $user->role->name !== "Администратор") {
            abort(403, "Доступ запрещён");
        }

        return $next($request);
    }
}
