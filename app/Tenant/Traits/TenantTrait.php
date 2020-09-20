<?php

namespace App\Tenant\Traits;

use App\Models\Tenant;
use App\Tenant\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

trait TenantTrait
{
    protected static function booted()
    {
        static::addGlobalScope(new TenantScope());

        static::creating(function (Model $model) {
            $tenant = \Tenant::getTenant();

            if ($tenant) {
                $model->tenant_id = $tenant->id;
            }

            $model->uuid = Uuid::uuid4();

        });
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
