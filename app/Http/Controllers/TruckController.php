<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Truck;
use App\Http\Resources\Truck as TruckResource;
use App\Http\Resources\Neighborhood as NeighborhoodResource;
use App\Http\Resources\NeighborhoodCollection as NeighborhoodCollection;
use App\Http\Resources\Complaint as ComplaintResource;
use App\Http\Resources\ComplaintCollection as ComplaintCollection;
use App\Http\Resources\TruckCollection as TruckCollection;
use App\Models\Neighborhood;
use Illuminate\Broadcasting\Broadcasters\NullBroadcaster;
use Illuminate\Http\Request;


class TruckController extends Controller
{
    public function index(){
        $this->authorize('viewAny', Truck::class);
        return new TruckCollection(Truck::paginate(10));
    }
    public function show(Truck $truck){
        $this->authorize('view',$truck);
        return response()->json(new TruckResource($truck),200);
    }

    public function showTrucksDriver(){
        $this->authorize('viewAny', Truck::class);
        $drivers = Truck::where('user_id','!=',NULL)->get();
        return response()->json(new TruckCollection($drivers), 200);
    }

    public function showTrucksNoDriver(){
        $this->authorize('viewAny', Truck::class);
        $noDrivers = Truck::where('user_id',NULL)->get();
        return response()->json($noDrivers, 200);
    }

    public function showTrucksWorking(){
        $this->authorize('viewAny', Truck::class);
        $working =Truck::where('working',true)->get();
        return response()->json(new TruckCollection($working), 200);
    }

    public function showTrucksNoWorking(){
        $this->authorize('viewAny', Truck::class);
        $noWorking = Truck::where('working',false)->get();
        return response()->json($noWorking, 200);
    }

    public function showTruckComplaints(Truck $truck){
        $this->authorize('viewAny', Truck::class);
        $comlaints = Complaint::where('truck_id', $truck['id'])->get();
        return response()->json(new ComplaintCollection($comlaints), 200);
    }

    public function showTrucksNeighborhood(Truck $truck, Neighborhood $neighborhood)
    {
        $this->authorize('viewAny', Truck::class);
        $truck= $neighborhood->where('truck_id', $truck['id'])->get();
        return response()->json(new NeighborhoodCollection($truck), 200);
    }

    public function store(Request $request)
    {
        $this->authorize('create',Truck::class);
        $messages= [
            'required'=> 'El campo :attribute es obligatorio.',
        ];
        $request->validate([
            'license_plate' => 'required|alpha_dash|unique:trucks|max:8',
            'type' => 'required|string|max:10',
            'working' => 'required|boolean',
        ],$messages);
        $truck = Truck::create($request->all());
        $truck->user_id = null;
        $truck->save();
        return response()->json($truck, 201);
    }

    public function update(Request $request, Truck $truck){
        $this->authorize('update',$truck);
        $request->validate([
            'license_plate' => 'required|alpha_dash|unique:trucks,license_plate,'.$truck->id.'|max:8',
            'type' => 'required|string|max:10',
            'working' => 'required|boolean',
        ]);

        $truck ->update($request->all());
        return response()->json($truck, 200);
    }

    public function delete(Truck $truck){
        $this->authorize('delete',$truck);
        $truck->delete();
        return response()->json(null, 204);
    }
}
