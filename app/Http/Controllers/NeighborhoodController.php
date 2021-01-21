<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Neighborhood;
use App\Http\Resources\Neighborhood as NeighborhoodResource;
use App\Http\Resources\NeighborhoodCollection;
use App\Models\Truck;
use App\Models\User;
use Illuminate\Http\Request;

class NeighborhoodController extends Controller
{
    public function index()
    {
        $this->authorize('view',Neighborhood::class);
        return new NeighborhoodCollection(Neighborhood::paginate(10));
    }

    public function show(Neighborhood $neighborhood)
    {
        $this->authorize('view',$neighborhood);
        return response()->json(new NeighborhoodResource($neighborhood), 200);;
    }

    public function showNeighborhoodsComplaint(Neighborhood $neighborhood)
    {
        $complaints = Complaint::all();
        $neighborhood = $complaints->where('neighborhood_id', $neighborhood['id']);
        return response()->json($neighborhood, 200);
    }

    public function showTruckOfNeighborhood(Neighborhood $neighborhood)
    {
        $trucks = Truck::all();
        $neighborhood = $trucks->where('id', $neighborhood['truck_id']);
        return response()->json($neighborhood, 200);
    }

    public function showDriverOfNeighborhood(Neighborhood $neighborhood)
    {
        $driver = array();
        $truck = $neighborhood->truck;
        $user = $truck->user;
        $driver[]=$user;

        return  response()->json($driver, 200);
    }

    public function store(Request $request)
    {
        $this->authorize('create',Neighborhood::class);
        $messages= [
            'required'=> 'El campo :attribute es obligatorio.',
        ];

        $request->validate([
            'start_time'=>'required|date_format:H:i:s',
            'end_time'=>'required|date_format:H:i:s|after:start_time',
            'days' =>'required|string|max:255',
            'link' =>'required|string',
            'name'=>'required|string|max:255',
        ],$messages);

        $neighborhood = Neighborhood::create($request->all());
        return response()->json($neighborhood, 201);
    }

    public function update(Request $request, Neighborhood $neighborhood)
    {
        $this->authorize('update',$neighborhood);
        $neighborhood->update($request->all());
        return response()->json($neighborhood, 200);
    }
    public function delete(Neighborhood $neighborhood)
    {
        $this->authorize('delete',$neighborhood);
        $neighborhood->delete();
        return response()->json(null, 204);
    }
}
