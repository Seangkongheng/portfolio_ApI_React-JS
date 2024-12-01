<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'description'=>'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $objAbout = new About();
        $objAbout->description = $request->input('description');
        $objAbout->image = $request->file('image')->store('image','public');
        $objAbout->save();
        return response()->json(['message' => 'About added successfully', 'brand' => $objAbout], 201);
    }

    public function index(){
        $objAbout=About::all()->map(function($objAbout){
            return[
                'id'=>$objAbout->description,
                'image'=>url('storage/'.$objAbout->image)
            ];
        });
        return response()->json($objAbout);
    }
}
