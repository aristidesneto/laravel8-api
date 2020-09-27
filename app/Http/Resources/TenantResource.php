<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TenantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'uuid' => $this->uuid,
            'name' => $this->name,
            'slug' => $this->slug,
            'cnpj' => $this->cnpj,
            'email' => $this->email,
            'address' => $this->address,
            'address_district' => $this->address_district,
            'address_number' => $this->address_number,
            'cep' => $this->cep,
            'city' => $this->city,
            'state' => $this->state,
            'phones' => PhoneResource::collection($this->phones)
        ];
    }
}
