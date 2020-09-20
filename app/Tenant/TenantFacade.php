<?php
declare(strict_types=1);

namespace App\Tenant;

use Illuminate\Support\Facades\Facade;

class TenantFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return TenantManager::class;
    }
}
