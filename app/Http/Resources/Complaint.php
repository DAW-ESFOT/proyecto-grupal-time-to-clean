<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Complaint extends JsonResource
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
            'complaint'=> $this->complaint,
            'username'=> $this->username,
            'email'=> $this->email,
            'state'=> $this->state,
            'observation'=>$this->observation,
            'neighborhood_id'=> $this->neighborhood_id,
            //'neighborhood_id'=> new NeighborhoodResource(Neighborhood::find($this->neighborhood_id)),
        ];
    }
}
