<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Exception;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index(){
        $objExperience=Experience::orderBy('id','desc')->get();
        return response()->json($objExperience);
    }
    public function store(Request $request){
        try{
            $objExperience = new Experience();
            $objExperience->description = $request->input('description');
            $objExperience->save();
            return response()->json(["message"=>"Experience add successfully"]);
        }catch(Exception $e){
            return response()->json($e->getMessage());
        }

    }

    public function update(Request $request,$id){
        try{
            $objExperience =Experience::find($id);
            $objExperience->description = $request->input('description');
            $objExperience->udate();
            return response()->json(["message"=>"Experience update successfully",201]);
        }catch(Exception $e){
            return response()->json($e->getMessage());
        }
    }

    public function destroy($id){
        try{
            $objExperience =Experience::find($id);
            $objExperience->delete();
            return response()->json(["message"=>"Experience delete successfully",201]);
        }catch(Exception $e){
            return response()->json($e->getMessage());
        }
    }
}
