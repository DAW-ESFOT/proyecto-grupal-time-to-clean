<?php

namespace App\Http\Resources;
use App\Models\Truck;
use App\Http\Resources\Truck as TruckResource;
use Illuminate\Http\Resources\Json\JsonResource;

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
        return [
            'id' => $this->id,
            'name'=>$this->name,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'days'=>$this->days,
            'link'=>$this->link,
            'truck_id'=> $this->truck_id,
            //'truck_id'=> new TruckResource(Truck::find($this->truck_id)),
        ];
    }
}

