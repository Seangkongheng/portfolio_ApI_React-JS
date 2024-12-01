<?php
namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{

    public function index() {
        $objProject = Project::all()->map(function ($objProject) {
            return [
                'id' => $objProject->id,
                'name'=>$objProject->name,
                'category_id'=>$objProject->category_id,
                'image' => Storage::url($objProject->image)
            ];
        });
        return response()->json($objProject);
    }
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'skill_id' => 'required|integer',
            'url_project' => 'required',
            'image' => 'nullable',
            'thumbnail' => 'nullable',
            'description' => 'nullable|string',
        ]);

        try {
            $objProject = new Project();
            $objProject->name = $request->input('name');
            $objProject->category_id = $request->input('category_id');
            $objProject->skill_id = $request->input('skill_id');
            $objProject->url_project = $request->input('url_project');

            if ($request->hasFile('image')) {
                $objProject->image = $request->file('image')->store('images', 'public');
            }
            if ($request->hasFile('image')) {
                $objProject->thumbnail = $request->file('thumbnail')->store('thumbnail', 'public');
            }


            $objProject->description = $request->input('description');
            $objProject->save();

            return response()->json(['message' => 'Project added successfully!', 'project' => $objProject], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to add project: ' . $e->getMessage()], 500);
        }
    }

}





