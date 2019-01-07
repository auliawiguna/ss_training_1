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


Route::get('/register', 'RegistrationController@registerform')->middleware('guest');
Route::post('/register', 'RegistrationController@registersave')->middleware('guest');
Route::get('/', 'LoginController@loginform')->name('login')->middleware('guest');
Route::post('/login', 'LoginController@loginauth')->middleware('guest');
Route::get('/logout', 'LoginController@logout')->middleware('auth');

Route::get('/dashboard', 'DashboardController@index')->middleware('auth');
Route::get('/createlink', 'DashboardController@createlink')->middleware('auth');
Route::get('/home', 'DashboardController@index')->middleware('auth');
Route::get('/datatable', 'DashboardController@datatable')->middleware('auth');
Route::get('/i/{url}', 'DashboardController@goto')->middleware('auth');
Route::get('/view/{id}', 'DashboardController@view')->middleware('auth');
Route::get('backend/page/{page}', function ($page) {
    return view('backend/'.$page);
    //
})->name('backend')->middleware('auth');