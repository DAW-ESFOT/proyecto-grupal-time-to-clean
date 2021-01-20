<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Http\Resources\Complaint as ComplaintResource;
use App\Http\Resources\ComplaintCollection as ComplaintCollection;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index(){
        return new ComplaintCollection(Complaint::paginate(10));
    }
    public function show(Complaint $complaint){
        return response()->json(new ComplaintResource($complaint),200);
    }

    public function showDriversWithComplaints(){

        $drivers = array();
        $complaints = Complaint::all();

        foreach($complaints as $complaint){
            //$neighborhood = $complaint->neighborhood()->where(  );  ->limit()
            $neighborhood = $complaint->neighborhood;
            $truck = $neighborhood->truck;
            $user = $truck->user;
            $drivers[]=$user;
        }
        return  response()->json($drivers, 200);
    }

    public function store(Request $request)
    {
        $messages= [
            'required'=> 'El campo :attribute es obligatorio.',
        ];

        $request->validate([
            'complaint' =>'required',
            'username' =>'required|string|max:35',
            'email'=>'required|string|max:35',
        ],$messages);

        $complaint = Complaint::create($request->all());
        return response()->json($complaint, 201);
    }

    public function update(Request $request, Complaint $complaint)
    {
        $messages= [
            'required'=> 'El campo :attribute es obligatorio.',
        ];

        $request->validate([
            'complaint' =>'required',
            'username' =>'required|string|max:35',
            'email'=>'required|string|max:35',
        ],$messages);

        $complaint ->update($request->all());
        return response()->json($complaint, 200);
    }
    public function delete(Complaint $complaint){
        $complaint->delete();
        return response()->json(null, 204);
    }
}
