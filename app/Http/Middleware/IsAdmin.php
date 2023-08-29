<?php

namespace App\Http\Middleware;

use App\Enums\UserTypeEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userType = Auth::user()->usertype;
        if ($userType == UserTypeEnum::ADMIN->value) {
            return $next($request);
        }
        Auth::logout();
        return redirect('/sign-in')->with('error', 'You don\'t have admin access');
    }
}
