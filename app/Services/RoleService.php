<?php
declare(strict_types=1);

namespace App\Services;

use App\Http\Resources\RoleResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\Permission\Models\Role;

class RoleService implements Service
{
    public function list(): AnonymousResourceCollection
    {
        return RoleResource::collection(Role::get());
    }

    public function make(array $data): bool
    {
        // TODO: Implement make() method.
    }

    public function update(array $data, string $uuid): bool
    {
        // TODO: Implement update() method.
    }

    public function delete(string $uuid): bool
    {
        // TODO: Implement delete() method.
    }
}
