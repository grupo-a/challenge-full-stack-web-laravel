<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api'
], function () {
    Route::get('/students/{id}', 'StudentController@show')->name('api.students.show');
    Route::put('/students/{id}', 'StudentController@update')->name('api.students.update');
    Route::delete('/students/{id}', 'StudentController@destroy')->name('api.students.destroy');
    Route::post('/students', 'StudentController@store')->name('api.students.store');
    Route::get('/students', 'StudentController@index')->name('api.students.index');
});