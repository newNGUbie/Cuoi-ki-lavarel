<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(\Illuminate\Support\Facades\Auth::check()){
            $user = \Illuminate\Support\Facades\Auth::user();
            if($user->level == 1 || $user->level == 2){
                return $next($request);
            }
            else {
                return redirect('/dangnhap');
            }
        }
        else {
            return redirect('/dangnhap');
        }
    }
}
