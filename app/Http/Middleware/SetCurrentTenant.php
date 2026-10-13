<?php

namespace App\Http\Middleware;

use App\Support\TenantManager;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Resolves the tenant for the current request from the authenticated user
 * and stores it on the TenantManager singleton.
 */
class SetCurrentTenant
{
    public function __construct(protected TenantManager $tenants) {}

    public function handle(Request $request, Closure $next): Response
    {
        if ($user = $request->user()) {
            $this->tenants->set($user->tenant);
        }

        return $next($request);
    }
}
