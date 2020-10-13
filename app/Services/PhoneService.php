<?php
declare(strict_types=1);

namespace App\Services;

use App\Http\Resources\PhoneResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PhoneService
{
    public function getPhones(Model $model) : AnonymousResourceCollection
    {
        return PhoneResource::collection($model->phones);
    }

    public function make(array $data, Model $model) : bool
    {
        if ($data['main'] == 1) {
            $this->setAllMainPhoneToFalse($model);
        }

        $create = $model->phones()->create([
            'type' => $data['type'],
            'number' => $data['number'],
            'main' => $data['main'] == 1
        ]);

        if (!$create) {
            return false;
        }

        return true;
    }

    public function update(array $data, Model $model) : bool
    {
        if ($data['main'] == 1) {
            $this->setAllMainPhoneToFalse($model);
        }

        return $model->phones()->find($data['id'])->update([
            'type' => $data['type'],
            'number' => $data['number'],
            'main' => $data['main'] == 1
        ]);
    }

    private function setAllMainPhoneToFalse(Model $model) : void
    {
        $phones = $model->phones;

        foreach ($phones as $phone) {
            $phone->update([
                'main' => false
            ]);
        }
    }

}
