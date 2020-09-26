<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class Tenant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'name',
        'slug',
        'cnpj',
        'email',
        'address',
        'address_district',
        'address_number',
        'cep',
        'city',
        'state',
        'avatar'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    protected static function booted()
    {
        static::creating(function (Model $model) {
            $model->uuid = Uuid::uuid4();

            $slug = $model->slug === config('tenant.admin_tenant', 'master')
                ? config('tenant.admin_tenant', 'master')
                : Str::slug($model->name, '-');

            $model->slug = $slug;
        });
    }

    public function phones()
    {
        return $this->morphMany(Phone::class, 'phoneable');
    }
}
