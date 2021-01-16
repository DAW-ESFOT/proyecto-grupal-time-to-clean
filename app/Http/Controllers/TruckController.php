<?php

namespace App\Http\Controllers;

use App\Models\Truck;
use App\Http\Resources\Truck as TruckResource;
use App\Http\Resources\TruckCollection as TruckCollection;
use App\Models\Neighborhood;
use Illuminate\Http\Request;


class TruckController extends Controller
{
    public function index(){
        return new TruckCollection(Truck::paginate(10));
    }
    public function show(Truck $truck){
        return response()->json(new TruckResource($truck),200);
    }

    public function showTrucksNeighborhood(Truck $truck, Neighborhood $neighborhood)
    {
        $truck= $neighborhood->where('truck_id', $truck['id'])->get();
        return $truck;
    }

    public function store(Request $request)
    {
        $truck = Truck::create($request->all());
        return response()->json($truck, 201);
    }
    public function update(Request $request, Truck $truck){
        $truck ->update($request->all());
        return response()->json($truck, 200);
    }
    public function delete(Truck $truck){
        $truck->delete();
        return response()->json(null, 204);
    }
}
