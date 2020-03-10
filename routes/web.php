<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

Route::get('admin', 'Auth\LoginController@showLoginForm')->name('login');
    Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('admin/login', 'Auth\LoginController@login');
    Route::post('admin/logout', 'Auth\LoginController@logout')->name('logout');

Route::prefix('/')->group(function(){
    Route::get('/', 'SeatStatusController@booking');
});

Route::get('hris-employees', 'HRISEmployeeController@employees');

Route::group(['middleware' => ['auth']], function(){
    Route::group(['middleware' => 'sa'], function(){
        Route::get('users', 'UserController@index')->name('user.index');
        Route::get('user/{id}', 'UserController@destroy')->name('user.delete');

        Route::get('register', 'UserController@showRegistrationForm')->name('register');
        Route::post('register', 'UserController@register');
    });

    // Route::get('sync/{location}', 'TempEmployeeController@sync')->name('temp.employees');
    Route::get('syncc/davao', 'HRISEmployeeController@employees')->name('employees.dvo');
    Route::get('syncc/agusan', 'AgusanHRISController@agusan_employees')->name('employees.agusan');
    // Registration Routes...
    
    // END Registration

    // User Routes
    Route::get('change-password', 'UserController@changePassword')->name('change_password');
    Route::post('change-password', 'UserController@password');
    // END USER

    // SEATS
    Route::prefix('seat_status')->group(function(){
        Route::get('monday', 'SeatStatusController@monday')->name('seat.monday');
        Route::get('saturday', 'SeatStatusController@saturday')->name('seat.saturday');
        Route::post('/', 'SeatStatusController@cancel_all')->name('seat.cancel_all');
        Route::get('{id}', 'SeatStatusController@cancel')->name('seat.cancel');
        Route::get('{day}/print', 'SeatStatusController@print')->name('seat.print');
    });    
    // END SEATS

    // EMPLOYEES
    Route::prefix('employees')->group(function(){
        Route::match(['get', 'post'], '/', 'EmployeeController@index')->name('employee.index');
        Route::get('status', 'EmployeeStatusController@index')->name('status.index');

        Route::post('add-visitor', 'EmployeeController@addvisitor')->name('employee.addVisitor');
    });

    Route::match(['get', 'post'], 'priority', 'EmployeeStatusController@priority')->name('status.priority');
    Route::get('priority/{id}', 'EmployeeStatusController@remove_priority')->name('status.rmpriority');

    Route::match(['get', 'post'], 'blacklist', 'EmployeeStatusController@blacklist')->name('status.blacklist');
    Route::get('blacklist/{id}', 'EmployeeStatusController@remove_blacklist')->name('status.rmblacklist');

    // Route::get('priority/{id}', 'EmployeeController@priority')->name('employee.priority');
    // Route::get('blacklist/{id}', 'EmployeeController@blacklist')->name('employee.blacklist');
    // END EMPLOYEES

    // SCHEDULE
    Route::get('schedule', 'ScheduleController@index')->name('schedule.index');
    // END SCHEDULE

    // FEEDBACK
    Route::get('feedback', 'FeedbackController@index')->name('feedback.index');
    // END FEEDBACK
    
    // BOOKING HISTORY
    Route::get('bookings-history', 'SeatLogsController@index')->name('seat_logs.index');
    // END BOOKING HISTORY

    // DESTINATION
    Route::get('destination', 'DestinationController@index')->name('destination.index');
    // END DESTINATION
});
