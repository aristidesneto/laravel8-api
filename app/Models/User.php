<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, SoftDeletes, TenantTrait;

    protected $fillable = [
        'tenant_id', 'name', 'email', 'password', 'cpf', 'birthday', 'active'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = [
        'created_at', 'updated_at', 'birthday'
    ];

    public function fill(array $attributes)
    {
        !isset($attributes['password']) ?: $attributes['password'] = bcrypt($attributes['password']);

        return parent::fill($attributes);
    }

    public function userable()
    {
        return $this->morphTo();
    }

//    public function resident()
//    {
//        return $this->morphMany(Resident::class, 'userable');
//    }

    public function phones()
    {
        return $this->morphMany(Phone::class, 'phoneable');
    }
}
