<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $objBrand = new Brand();
        $objBrand->logo = $request->file('logo')->store( 'brand', 'public');
        $objBrand->save();

        return response()->json(['message' => 'Brand added successfully', 'brand' => $objBrand], 201);
    }

    public function index() {
        $brands = Brand::all()->map(function ($brand) {
            return [
                'id' => $brand->id,
                'logo' => url('storage/' . $brand->logo)
            ];
        });

        return response()->json($brands);
    }




}
