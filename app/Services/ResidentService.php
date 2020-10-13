<?php
declare(strict_types=1);

namespace App\Services;

use App\Http\Resources\ResidentResource;
use App\Models\Phone;
use App\Models\Resident;
use App\Models\Tenant;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class ResidentService implements Service
{
    protected int $paginate = 150;

    public function list() : AnonymousResourceCollection
    {
        return ResidentResource::collection(
            Resident::with('user.tenant')->paginate($this->paginate)
        );
    }

    public function make(array $data) : bool
    {
        DB::beginTransaction();

        $data['birthday'] = Carbon::createFromFormat('d/m/Y', $data['birthday']);
        $data['cpf'] = validateCpf($data['cpf']);
        $data['password'] = bcrypt('password');

        $user = new User();
        $user->fill($data);
        $user = $user->create($data);

        $data['user_id'] = $user->id;
        $resident = Resident::create($data);

        if ($user && $resident) {
            DB::commit();
            return true;
        }

        DB::rollBack();
        return false;
    }

    public function update(array $data, string $uuid) : bool
    {
        DB::beginTransaction();

        $resident = Resident::where('uuid', $uuid)->first();

        $data['birthday'] = Carbon::createFromFormat('d/m/Y', $data['birthday']);
        $data['cpf'] = validateCpf($data['cpf']);

        $resident->fill($data);

        if ($resident->update($data)) {
            $user = $resident->user;
            $user->fill($data);

            if ($user->update($data)) {
                DB::commit();
                return true;
            }
        }

        DB::rollBack();
        return false;
    }

    public function delete(string $uuid) : bool
    {
        DB::beginTransaction();

        $resident = Resident::where('uuid', $uuid)->first();

        if ($resident->delete() && $resident->user->delete()) {
            DB::commit();
            return true;
        }

        DB::rollBack();
        return false;
    }

    public function show(string $uuid) : ResidentResource
    {
        $resident = Resident::with('user.tenant', 'user.phones')
                        ->where('uuid', $uuid)
                        ->first();

        return new ResidentResource($resident);
    }
}
