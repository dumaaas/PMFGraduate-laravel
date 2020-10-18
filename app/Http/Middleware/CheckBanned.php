<?php

namespace App\Http\Middleware;
use Auth;
use Illuminate\Support\Str;


use Closure;

class CheckBanned
{
    //handle an incoming request
    public function handle($request, Closure $next)
    {
        //check if user is banned, if is banned and loged in, then logut him and show message with details
        if (Auth::check() && Auth::user()->banned_until && now()->lessThan(Auth::user()->banned_until)) {
            $banned_days = now()->diffInDays(Auth::user()->banned_until);
            auth()->logout();

            if ($banned_days > 14) {
                $message = 'Your account has been suspended. Please contact administrator.';
            } else {
                $message = 'Your account has been suspended for '.$banned_days.' '.Str::plural('day', $banned_days).
                '. Please contact administrator.';
            }

            return redirect()->route('login')->withMessage($message);
        }

        return $next($request);
    }
}
