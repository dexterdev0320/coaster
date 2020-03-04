<?php
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('employee', 'EmployeeController@search_employee');

Route::post('seats', 'SeatStatusController@seats');

Route::put('seat', 'SeatStatusController@update');

Route::post('refresh-all', 'SeatStatusController@refresh_all');

Route::get('destinations', 'DestinationController@fetch_all_destination');
Route::post('destination', 'DestinationController@new_destination');
Route::delete('destination/{id}', 'DestinationController@delete_destination');
Route::put('destination/{id}', 'DestinationController@update_destination');

Route::post('feedback/store', 'FeedbackController@store');

Route::get('latest_sched', 'ScheduleController@latest_sched');

Route::get('trip_sched', 'TripScheduleController@trip_sched');

Route::post('sync/davao', 'HRISEmployeeController@employees');
Route::post('sync/agusan', 'AgusanHRISController@agusan_employees');