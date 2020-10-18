<?php
declare(strict_types=1);

namespace App\Services;

use App\Http\Resources\TenantResource;
use App\Models\Phone;
use App\Models\Tenant;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class TenantService implements Service
{
    protected int $paginate = 15;

    public function list(): AnonymousResourceCollection
    {
        return TenantResource::collection(
            Tenant::orderBy('name')->paginate($this->paginate)
        );
    }

    public function make(array $data): bool
    {
        DB::beginTransaction();

        $tenant = new Tenant();
        $tenant->fill($data);

        $tenant = $tenant->create($data);

        if ($tenant) {

            if (isset($data['phones']) && $data['phones'] != null) {
                foreach ($data['phones'] as $value) {
                    $value['tenant_id'] = $tenant->id;
                    $phone = new Phone($value);
                    $phone = $tenant->phones()->save($phone);
                }

                if (!$phone) {
                    DB::rollBack();
                    return false;
                }
            }

            DB::commit();
            return true;
        }

        DB::rollBack();
        return false;
    }

    public function update(array $data, string $uuid): bool
    {
        $tenant = Tenant::where('uuid', $uuid)->first();

        if ($tenant) {
            $data['cep'] = str_replace('-', '', $data['cep']);
            $data['cnpj'] = str_replace('.', '', str_replace('/', '', str_replace('-', '', $data['cnpj'])));

            $tenant->fill($data);
            return $tenant->update($data);
        }

        return false;
    }

    public function delete(string $uuid): bool
    {
        $tenant = Tenant::where('uuid', $uuid)->first();

        if ($tenant && $tenant->delete()) {
            return true;
        }

        return false;
    }

    public function show(string $uuid) : ?TenantResource
    {
        $tenant = Tenant::with('phones')
                        ->where('uuid', $uuid)->first();

        return $tenant ? new TenantResource($tenant) : null;
    }
}
