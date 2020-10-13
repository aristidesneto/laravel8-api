<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
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

        if (!\Tenant::isTenantMaster($tenant)) {
            \Tenant::setTenant($tenant);
        }

        $allowedVerbs = ['POST', 'PUT', 'DELETE'];

        // Condição para usuário master quando for realizar um cadastro no sistema
        if (in_array($request->method(), $allowedVerbs) && \Tenant::isTenantMaster($tenant)) {
            $uuid = $request->tenant ?? $request->tenant_uuid;
            $tenant = Tenant::where('uuid', $uuid)->firstOrFail();
            \Tenant::setTenant($tenant);
        }

        return $next($request);
    }
}
