<?php

namespace App\Http\Controllers;

use App\Models\Neighborhoods;
use Illuminate\Http\Request;

class NeighborhoodController extends Controller
{
    public function index()
    {
        return Neighborhoods::all();
    }
    public function show(Neighborhoods $neighborhood)
    {
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
