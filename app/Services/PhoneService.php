<?php
declare(strict_types=1);

namespace App\Services;

use App\Http\Resources\PhoneResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PhoneService
{
    public function getPhones(Model $model) : AnonymousResourceCollection
    {
        return PhoneResource::collection($model->phones);
    }

    public function make(array $data, User $user) : bool
    {
        if ($data['main'] == 1) {
            $this->setAllMainPhoneToFalse($user);
        }

        $create = $user->phones()->create([
            'type' => $data['type'],
            'number' => $data['number'],
            'main' => $data['main']
        ]);

        return $create ? true : false;
    }

    public function update(array $data, User $user) : bool
    {
        if ($data['main'] == 1) {
            $this->setAllMainPhoneToFalse($user);
        }

        return $user->phones()->find($data['id'])->update([
            'type' => $data['type'],
            'number' => $data['number'],
            'main' => $data['main']
        ]);
    }

    private function setAllMainPhoneToFalse(User $user) : void
    {
        $phones = $user->phones;

        foreach ($phones as $phone) {
            $phone->update([
                'main' => false
            ]);
        }
    }

}
