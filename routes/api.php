<?php

use App\Models\Neighborhood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Complaint;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
//Users-Drivers
Route::post('register', 'App\Http\Controllers\UserController@register');
Route::post('login', 'App\Http\Controllers\UserController@authenticate');

Route::get('neighborhoods', 'App\Http\Controllers\NeighborhoodController@index');
Route::get('neighborhoods/{neighborhood}', 'App\Http\Controllers\NeighborhoodController@show');
Route::get('neighborhoods/{neighborhood}/complaints', 'App\Http\Controllers\NeighborhoodController@showNeighborhoodsComplaint');
Route::get('trucks/{truck}/neighborhoods', 'App\Http\Controllers\TruckController@showTrucksNeighborhood');
Route::get('complaints/drivers', 'App\Http\Controllers\ComplaintController@showDriversWithComplaints');



Route::post('complaints', 'App\Http\Controllers\ComplaintController@store');

Route::get('users/trucks/neighborhoods/complaints', 'App\Http\Controllers\UserController@showUserWithComplaints');


Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('users', 'App\Http\Controllers\UserController@getAuthenticatedUser');
    Route::get('users/{user}', 'App\Http\Controllers\UserController@show');
    Route::post('users', 'App\Http\Controllers\UserController@store');
    Route::put('users/{user}', 'App\Http\Controllers\UserController@update');
    Route::delete('users/{user}', 'App\Http\Controllers\UserController@delete');

    Route::post('neighborhoods', 'App\Http\Controllers\NeighborhoodController@store');
    Route::put('neighborhoods/{neighborhood}', 'App\Http\Controllers\NeighborhoodController@update');
    Route::delete('neighborhoods/{neighborhood}', 'App\Http\Controllers\NeighborhoodController@delete');

    Route::get('complaints', 'App\Http\Controllers\ComplaintController@index');
    Route::get('complaints/{complaint}', 'App\Http\Controllers\ComplaintController@show');
    Route::put('complaints/{complaint}', 'App\Http\Controllers\ComplaintController@update');
    Route::delete('complaints/{complaint}', 'App\Http\Controllers\ComplaintController@delete');

    Route::get('trucks', 'App\Http\Controllers\truckController@index');
    Route::get('trucks/{truck}', 'App\Http\Controllers\truckController@show');
    Route::put('trucks/{truck}', 'App\Http\Controllers\truckController@update');
    Route::delete('trucks/{truck}', 'App\Http\Controllers\truckController@delete');
});
