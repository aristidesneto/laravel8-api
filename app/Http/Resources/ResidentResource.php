<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResidentResource extends JsonResource
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
            'bloco' => $this->bloco,
            'apartamento' => $this->apartamento,
            'tipo' => $this->tipo,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'name' => $this->user->name,
            'email' => $this->user->email,
            'tenant' => $this->user->tenant->name,
            'city' => $this->user->tenant->city . '/' . $this->user->tenant->state,
            'cpf' => $this->user->cpf,
            'birthday' => $this->user->birthday,
            'phones' => PhoneResource::collection($this->user->phones),
            'active' => $this->user->active
        ];
    }
}
