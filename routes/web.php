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

        // Registration Routes...
        Route::get('admin/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
        Route::post('admin/register', 'Auth\RegisterController@register');

        // Password Reset Routes...
        Route::get('admin/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
        Route::post('admin/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
        Route::get('admin/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
        Route::post('admin/password/reset', 'Auth\ResetPasswordController@reset');



Route::prefix('admin')->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');

    Route::prefix('employee')->group(function(){
        Route::match(['get', 'post'], '/', 'EmployeeController@index')->name('employee.index');
        // Route::get('/', 'EmployeeController@index')->name('employee.index');
        // Route::post('search', 'EmployeeController@search')->name('employee.search');
        // Route::match(['GET', 'POST'], 'search', 'EmployeeController@search')->name('employee.search');
        Route::get('priority/{id}', 'EmployeeController@priority')->name('employee.priority');
        Route::get('blacklist/{id}', 'EmployeeController@blacklist')->name('employee.blacklist');

        Route::get('status', 'EmployeeStatusController@index')->name('status.index');
        
        Route::match(['get', 'post'], 'status/priority', 'EmployeeStatusController@priority')->name('status.priority');
        Route::get('status/priority/{id}', 'EmployeeStatusController@remove_priority')->name('status.rmpriority');
        // Route::get('status/priority/{id}', 'EmployeeStatusController@priority')->name('status.priority');

        Route::match(['get', 'post'], 'status/blacklist', 'EmployeeStatusController@blacklist')->name('status.blacklist');
        Route::get('status/blacklist/{id}', 'EmployeeStatusController@remove_blacklist')->name('status.rmblacklist');
    });

    Route::prefix('booking')->group(function(){
        Route::get('/', 'BookingController@index')->name('booking.index');
    });

    Route::prefix('schedule')->group(function(){
        Route::get('/', 'ScheduleController@index')->name('schedule.index');
    });

    Route::get('priority', 'EmployeePriorityController@index')->name('priority.index');
    Route::get('blacklist', 'EmployeePriorityController@index')->name('blacklist.index');

    Route::get('feedback', 'FeedbackController@index')->name('feedback.index');

    Route::get('seat_status', 'SeatStatusController@index')->name('seat.index');
    Route::post('seat_status', 'SeatStatusController@updateall')->name('seat.updateall');
    Route::get('seat_status/{id}', 'SeatStatusController@indiupdate')->name('seat.updateindi');
});


Route::prefix('/')->group(function(){
    Route::get('/', 'EmployeesController@index')->name('employees.index');
});

Route::get('testing', 'EmployeesController@testing');