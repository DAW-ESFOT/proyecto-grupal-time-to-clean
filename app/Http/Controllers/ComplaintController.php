<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index(){
        return Complaint::all();
    }
    public function show(Complaint $complaint){
        return $complaint;
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

    //$user



    public function store(Request $request)
    {
        $complaint = Complaint::create($request->all());
        return response()->json($complaint, 201);
    }
    public function update(Request $request, Complaint $complaint){
        $complaint ->update($request->all());
        return response()->json($complaint, 200);
    }
    public function delete(Complaint $complaint){
        $complaint->delete();
        return response()->json(null, 204);
    }
}
