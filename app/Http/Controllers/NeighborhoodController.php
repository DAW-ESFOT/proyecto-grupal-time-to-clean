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
        return new NeighborhoodCollection(Neighborhood::paginate(10));;
    }
    public function show(Neighborhood $neighborhood)
    {
        return response()->json(new NeighborhoodResource($neighborhood), 200);;
    }


    public function store(Request $request)
    {
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
        $neighborhood->update($request->all());
        return response()->json($neighborhood, 200);
    }
    public function delete(Neighborhood $neighborhood)
    {
        $neighborhood->delete();
        return response()->json(null, 204);
    }
}
