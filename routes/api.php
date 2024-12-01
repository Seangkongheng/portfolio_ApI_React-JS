<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\UserController;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register',[UserController::class , "register"]);
Route::post('login',[UserController::class , "login"]);
Route::middleware('auth:api')->group(function () {
    Route::get('user', [UserController::class, 'index']);
    Route::post('education',[EducationController::class , "store"]);
    Route::get('education/index',[EducationController::class , "index"]);
    Route::put('education/update/{id}', [EducationController::class, 'update']);
    Route::delete('education/delete/{id}', [EducationController::class, 'destroy']);
    Route::post('experience/store',[ExperienceController::class , "store"]);
    Route::get('experience/index',[ExperienceController::class , "index"]);
    Route::put('experience/update/{id}', [ExperienceController::class, 'update']);
    Route::delete('experience/delete/{id}', [ExperienceController::class, 'destroy']);
    Route::post('skill/store',[SkillController::class ,"store"]);
    Route::get('skill/index',[SkillController::class , "index"]);
    Route::put('skill/update/{id}', [SkillController::class, 'update']);
    Route::delete('skill/delete/{id}', [SkillController::class, 'destroy']);
    Route::post('logout', [UserController::class, 'logout']);
    Route::post('brand/store', [BrandController::class, 'store']);
    Route::get('brands', [BrandController::class, 'index']);
    Route::post('contact/store', [ContactController::class, 'store']);
    Route::get('contacts', [ContactController::class, 'index']);
    Route::post('about/store', [AboutController::class, 'store']);
    Route::post('category/store', [CategoryController::class, 'store']);
    Route::put('category/update/{id}', [CategoryController::class, 'update']);
    Route::delete('category/delete/{id}', [CategoryController::class, 'destroy']);
    Route::get('abouts', [AboutController::class, 'index']);
    Route::get('category', [CategoryController::class, 'index']);
    Route::post('project/store', [ProjectController::class, 'store']);
    Route::get('project', [ProjectController::class, 'index']);
});
