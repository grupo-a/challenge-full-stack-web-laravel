<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/', function () {
    return response()->json(["apiStatus" => "healthy"], 200);
});

Route::group(['prefix' => 'alunos'], function () {
    Route::get('/', function () {
        $studentController = new StudentController;
        $response = $studentController->index();
        return $response;
    });

    Route::get('/{id}', function ($id) {
        $studentController = new StudentController;
        $response = $studentController->show($id);
        return $response;
    });

    Route::post('/', function (Request $request) {
        $studentController = new StudentController;
        $response = $studentController->store($request);
        return $response;
    });

    Route::put('/{id}', function ($id, Request $request) {
        $studentController = new StudentController;
        $response = $studentController->edit($id, $request);
        return $response;
    });
});
