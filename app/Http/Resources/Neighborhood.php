<?php

namespace App\Http\Resources;
use Exception;
use App\Models\Truck;
use App\Http\Resources\Truck as TruckResource;
use App\Http\Resources\Complaint as ComplaintResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Tymon\JWTAuth\Facades\JWTAuth;

class Neighborhood extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $isAdmin = false;
        try {
            $isAdmin = JWTAuth::parseToken()->authenticate()->role === 'ROLE_SUPERADMIN';
        } catch (Exception $error) {
        }
        return [
            'id' => $this->id,
            'name'=>$this->name,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'days'=>$this->days,
            'link'=>$this->link,
            'truck'=> $this->when($isAdmin,new TruckResource(Truck::find($this->truck_id))),


        ];

    }
}

