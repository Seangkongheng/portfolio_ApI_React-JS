<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index(){
        $objSkill=Skill::orderBy('id','desc')->get();
        return response()->json($objSkill);
    }
    public function store(Request $request){
        $objSkill = new Skill();
        $objSkill->name = $request->input('name');
        $objSkill->percent = $request->input('percent');
        $objSkill->save();
        return response()->json(["message"=>"Skill add successfully",201]);
    }

    public function update(Request $request,$id){
        $objSkill=Skill::find($id);
        $objSkill->name = $request->input('name');
        $objSkill->percent = $request->input('percent');
        $objSkill->update();
        return response()->json(["message"=>"Skill update successfully",201]);
    }
    public function destroy($id){
        $objSkill=Skill::find($id);
        $objSkill->delete();
        return response()->json(["message"=>"Skill delete successfully",201]);
    }
}
