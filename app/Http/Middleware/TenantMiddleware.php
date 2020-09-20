<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TenantMiddleware
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

        if ($tenant->slug !== config('tenant.admin_tenant')) {
            \Tenant::setTenant($tenant);
        }

        return $next($request);
    }
}
