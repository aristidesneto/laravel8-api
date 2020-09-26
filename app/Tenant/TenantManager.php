<?php
declare(strict_types=1);

namespace App\Tenant;

use App\Models\Tenant;

class TenantManager
{
    private $tenant;

    public function getTenant() : ?Tenant
    {
        return $this->tenant;
    }

    public function setTenant($tenant) : void
    {
        $this->tenant = $tenant;
    }

    public function isTenantMaster(Tenant $tenant) : bool
    {
        return $tenant->slug === config('tenant.admin_tenant');
    }
}
