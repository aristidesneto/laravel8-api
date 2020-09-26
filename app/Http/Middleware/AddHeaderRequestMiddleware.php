<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AddHeaderRequestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->cookie(config('tenant.token_name', 'token'));

        $request->headers->add([
            'Access-Control-Allow-Origin' => '*',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ]);

//        $request->header('Accept', 'application/json');
//        $request->header('Authorization', 'Bearer ' . $token);

        return $next($request);
    }
}
