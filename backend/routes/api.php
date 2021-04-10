<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function(){
    return response()->json(["apiStatus" => "healthy"], 200);
});

Route::group(['prefix' => 'alunos'], function(){
    Route::get('/', function(){
        $studentController = new StudentController;
        return response()->json($studentController->index(), 200);
    });
});
