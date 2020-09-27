<?php


namespace App\Services;


use App\Http\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserService implements Service
{
    protected int $paginate = 15;

    public function list(): AnonymousResourceCollection
    {
        return UserResource::collection(
            User::with('tenant')->orderBy('name')->paginate($this->paginate)
        );
    }

    public function make(array $data): bool
    {
        $data['birthday'] = Carbon::createFromFormat('d/m/Y', $data['birthday']);
        $data['cpf'] = validateCpf($data['cpf']);

        $user = new User();
        $user->fill($data);

        return $user->create($data) ? true : false;
    }

    public function update(array $data, string $uuid): bool
    {
        $user = User::where('uuid', $uuid)->first();

        $data['birthday'] = Carbon::createFromFormat('d/m/Y', $data['birthday']);
        $data['cpf'] = validateCpf($data['cpf']);

        if ($user) {
            $user->fill($data);
            return $user->update($data);
        }

        return false;
    }

    public function delete(string $uuid): bool
    {
        $user = User::where('uuid', $uuid)->first();

        if ($user && $user->delete()) {
            return true;
        }

        return false;
    }

    public function show(string $uuid) : ?UserResource
    {
        $user = User::with('tenant')
                ->where('uuid', $uuid)->first();

        return $user ? new UserResource($user) : null;
    }
}
