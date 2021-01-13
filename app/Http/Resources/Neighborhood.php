<?php

namespace App\Http\Resources;

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

            //'truck_id'=> TruckResource::collection($this->id),
        ];
    }
}

