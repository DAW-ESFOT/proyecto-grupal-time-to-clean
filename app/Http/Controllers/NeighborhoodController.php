<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Neighborhoods;
use App\Http\Resources\Neighborhood as NeighborhoodResource;
use App\Http\Resources\NeighborhoodCollection;
use Illuminate\Http\Request;

class NeighborhoodController extends Controller
{
    public function index()
    {
        return new NeighborhoodCollection(Neighborhoods::paginate(10));;
    }
    public function show(Neighborhoods $neighborhood)
    {
        return response()->json(new NeighborhoodResource($neighborhood), 200);;
    }

    public function showNeighborhoodsComplaint(Neighborhoods $neighborhood, Complaint $complaints)
    {
        $neighborhood = $complaints->where('neighborhood_id', $neighborhood['id'])->get();
        return $neighborhood;
    }


    public function store(Request $request)
    {
        $neighborhood = Neighborhoods::create($request->all());
        return response()->json($neighborhood, 201);
    }
    public function update(Request $request, Neighborhoods $neighborhood)
    {
        $neighborhood->update($request->all());
        return response()->json($neighborhood, 200);
    }
    public function delete(Neighborhoods $neighborhood)
    {
        $neighborhood->delete();
        return response()->json(null, 204);
    }
}
