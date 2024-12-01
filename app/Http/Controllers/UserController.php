<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function register(Request $request)
    {
        // Create a new user instance
        $objUser = new User();
        $objUser->name = $request->input('name');
        $objUser->email = $request->input('email');
        $objUser->password = Hash::make($request->input('password'));

        // Save the user to the database first
        $objUser->save();

        // Generate the JWT token after the user has been saved
        $token = JWTAuth::fromUser($objUser);

        if ($objUser) {
            return response()->json(['token' => $token], 201); // Return token with 201 created status
        } else {
            return response()->json(["message" => "User registration failed"], 500); // Return error with 500 status
        }
    }

    function index(){
        $objUser=User::orderBy('id','desc')->get();
        return response()->json($objUser);
    }

    function login(Request $request){
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
        return response()->json(['token' => $token]);
    }

    
    function logout(Request $request){
        Auth::logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
}
