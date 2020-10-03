<?php
declare(strict_types=1);

namespace App\Services;

use App\Http\Resources\PhoneResource;
use App\Models\Phone;
use App\Models\User;
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
        foreach ($data as $item) {
            if ($item['main'] == 1) {
                $this->setAllMainPhoneToFalse($model);
            }
//            dd($model);
            $create = $model->phones()->create([
                'type' => $item['type'],
                'number' => $item['number'],
                'main' => $item['main']
            ]);

            if (!$create) {
                return false;
            }
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
            'main' => $data['main']
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
