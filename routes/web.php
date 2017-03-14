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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'admin'], function() {
    Route::resource('users', 'UsersController');
    Route::resource('roles', 'RolesController');
});

Route::get('/prueba', function(Illuminate\Http\Request $request) {
    $reg = App\Region::all();
    return view('prueba', compact('reg'));
});

Route::get('/prueba/{region}', function(App\Region $region) {
    $comunas = $region->comunas()->get();
    return $comunas;
});

Route::get('/prueba/comuna/{comuna}', function(App\Comuna $comuna) {
    $establecimientos = $comuna->establecimientos()->get();
    return $establecimientos;
});

Route::post('/prueba', 'TestController@test');