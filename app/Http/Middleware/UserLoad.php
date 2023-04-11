<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserLoad
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
        if (!session()->has('LoggedUser') AND ($request->path() != '/' AND $request->path() !== 'register')) {
            return redirect('');
        }
        if (session()->has('LoggedUser') && ($request->path() == '/' OR $request->path() === 'register')) {

            return back();
            // return redirect('home');
        }
        return $next($request);
    }
}
