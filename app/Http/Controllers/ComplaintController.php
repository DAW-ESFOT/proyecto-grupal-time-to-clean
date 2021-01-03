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
