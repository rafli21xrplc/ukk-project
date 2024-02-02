<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkMethod
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$methods): Response
    {
        dd($request->isMethod('post'));
        if (!in_array($request->method(), $methods)) {
            abort(405, 'Method Not Allowed');
        }

        return $next($request);
    }
}
