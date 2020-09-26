<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory, TenantTrait;

    protected $fillable = [
        'tenant_id', 'type', 'number', 'main'
    ];

    public function phoneable()
    {
        return $this->morphTo();
    }
}
