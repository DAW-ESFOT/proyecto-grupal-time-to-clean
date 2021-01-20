<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
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

    public function showTruckComplaints(Truck $truck){

        $trucksComplaints = array();
        $neighborhoods = Neighborhood::where('truck_id', $truck['id'])->get();
        //dd($neighborhoods);

        foreach($neighborhoods as $neighborhood){
            $complaints = $neighborhood->complaints->toArray();
            $trucksComplaints = array_merge($trucksComplaints, $complaints);
        }

        return response()->json($trucksComplaints, 200);
    }

    public function store(Request $request)
    {

        $request->validate([
            'license_plate' => 'required|alpha_dash|unique:trucks|max:7',
            'type' => 'required|string|max:10',
            'working' => 'required'|'boolean',
        ]);

        $truck = Truck::create($request->all());
        return response()->json($truck, 201);
    }
    public function update(Request $request, Truck $truck){

        $request->validate([
            'license_plate' => 'required|alpha_dash|unique:trucks,license_plate,'.$truck->id.'|max:7',
            'type' => 'required|string|max:10',
            'working' => 'required'|'boolean',
        ]);

        $truck ->update($request->all());
        return response()->json($truck, 200);
    }
    public function delete(Truck $truck){
        $truck->delete();
        return response()->json(null, 204);
    }
}
