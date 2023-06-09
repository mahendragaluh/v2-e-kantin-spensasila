<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class CekLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$levels): Response
    {
        if (in_array($request->user()->level_id, $levels)) {
            return $next($request);
        }
        if (Auth::user()->level_id == '1') {
            return redirect('/pengguna/users');
        } elseif (Auth::user()->level_id == '2') {
            return redirect('/top-up');
        } elseif (Auth::user()->level_id == '3') {
            return redirect('/menu');
        } elseif (Auth::user()->level_id == '4') {
            return redirect('/home');
        }
        return redirect('/');
    }
}
