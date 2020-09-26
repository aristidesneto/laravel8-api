<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'email' => $this->email,
            'cpf' => $this->cpf,
            'birthday' => $this->birthday->format('d/m/Y'),
            'active' => $this->active,
            'created_at' => $this->created_at->format('d/m/Y'),
            'tenant' => new TenantResource($this->tenant),
            'resident' => new ResidentResource($this->resident)
        ];
    }
}
