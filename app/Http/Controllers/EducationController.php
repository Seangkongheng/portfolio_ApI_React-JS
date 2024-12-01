<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index(){
        $objEducation=Education::orderBy('id','desc')->get();
        return response()->json($objEducation);
    }
    public function store(Request $request){
        $objEducation = new Education();
        $objEducation->description = $request->input('description');
        $objEducation->start_date = $request->input('start_date');
        $objEducation->end_date = $request->input('end_date');
        $objEducation->save();
        return response()->json(["message"=>"Education add successfully"]);
    }

    public function update(Request $request,$id){
        $objEducation = Education::find($id);
        $objEducation->description = $request->input('description');
        $objEducation->start_date = $request->input('start_date');
        $objEducation->end_date = $request->input('end_date');
        $objEducation->update();
        return response()->json(["message"=>"Education update successfully"]);
    }

    public function destroy($id){
        $objEducation = Education::find($id);
        $objEducation->delete();
        return response()->json(["message"=>"Education delete successfully"]);
    }
}
