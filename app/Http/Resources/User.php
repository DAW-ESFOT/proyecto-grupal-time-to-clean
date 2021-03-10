<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Truck;
use App\Http\Resources\Truck as TruckResource;

class User extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'lastname' => $this->lastname,
            'birthdate' => $this->birthdate,
            'type' => $this->type,
            'email' => $this->email,
            'role' => $this->role,
            'cellphone' => $this->cellphone,
            'truck'=>$this->truck!==null?$this->truck->license_plate:null
            ];
    }
}
