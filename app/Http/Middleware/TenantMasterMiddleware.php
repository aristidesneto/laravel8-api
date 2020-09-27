<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TenantMasterMiddleware
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
        $tenant = \Auth::user()->tenant;

        if (!\Tenant::isTenantMaster($tenant)) {
            return response()->json([
                'message' => 'Acesso negado'
            ], 401);
        }

        return $next($request);
    }
}
