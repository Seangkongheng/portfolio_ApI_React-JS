<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $objCategories = new Category();
        $objCategories->name = $request->input('name');
        $objCategories->save();
        return response()->json(['message' => 'Category add successfully'], 201);
    }

    public function index()
    {
        $objCategories = Category::all();
        return response()->json($objCategories);
    }

    public function update(Request $request, $id)
    {
        $objCategories = Category::find($id);
        if (!$objCategories) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        $objCategories->name = $request->input('name');
        $objCategories->update();
        return response()->json(['message' => 'Category updated successfully'], 200);
    }
    public function destroy($id)
    {
        $objCategories = Category::find($id);
        if (!$objCategories) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        $objCategories->delete();
        return response()->json(['message' => 'Category delete successfully'], 200);
    }


}
