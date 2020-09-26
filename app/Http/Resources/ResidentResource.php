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
            'name' => $this->user->name,
            'email' => $this->user->email,
            'tenant_uuid' => $this->user->tenant->uuid,
            'tenant_name' => $this->user->tenant->name,
            'tenant_city' => $this->user->tenant->city . '/' . $this->user->tenant->state,
            'cpf' => $this->user->cpf,
            'birthday' => $this->user->birthday->format('d/m/Y'),
            'phones' => PhoneResource::collection($this->user->phones),
            'active' => $this->user->active,
            'created_at' => $this->user->created_at->format('d/m/Y')
        ];
    }
}
