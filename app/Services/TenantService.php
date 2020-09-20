<?php
declare(strict_types=1);

namespace App\Services;

use App\Http\Resources\TenantResource;
use App\Models\Tenant;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TenantService implements Service
{
    protected int $paginate = 15;

    public function list(): AnonymousResourceCollection
    {
        return TenantResource::collection(Tenant::orderBy('name')->paginate($this->paginate));
    }

    public function make(array $data): bool
    {
        $tenant = new Tenant();
        $tenant->fill($data);

        return $tenant->create($data) ? true : false;
    }

    public function update(array $data, string $uuid): bool
    {
        $tenant = Tenant::where('uuid', $uuid)->first();
        $tenant->fill($data);

        if ($tenant->update($data)) {
            return true;
        }

        return false;
    }

    public function delete(string $uuid): bool
    {
        $tenant = Tenant::where('uuid', $uuid)->first();

        return $tenant->delete();
    }

    public function show(string $uuid) : TenantResource
    {
        $tenant = Tenant::where('uuid', $uuid)->first();

        return new TenantResource($tenant);
    }
}
