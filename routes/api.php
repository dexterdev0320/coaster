<?php

use Illuminate\Http\Request;

use App\Employee;
use App\Http\Resources\Employee as EmployeeReource;
use Illuminate\Support\Facades\Auth;

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



// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('employees', 'EmployeeController@indexapi');


Route::get('seats', 'SeatStatusController@indexapi');
Route::put('seat', 'SeatStatusController@update');

Route::match(['get', 'post'],'seat/code', 'SeatStatusController@searchCode');
// Route::match(['get', 'post'], 'seats/update', function(){
//     dd('hit');
// });
Route::get('available-seats', 'SeatStatusController@availableseats');

Route::get('destinations', 'DestinationController@indexapi');

