<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('citas')->group(function() {
    Route::post('/month', 'ApiCitasController@DaysInMonthCurrent');
    Route::get('/hours', 'ApiCitasController@SetHoursCalendarDate');
    Route::post('/hoursdate', 'ApiCitasController@getHoursDate');
    Route::post('/new','ApiCitasController@saveNewReserva');
    
});