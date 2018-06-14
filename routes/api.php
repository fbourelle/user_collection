<?php

use Illuminate\Http\Request;

use App\User;
use App\Http\Resources\UserCollection;
use Illuminate\Support\Facades\DB;

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

Route::get('/userscollection', function () {
    $users = DB::table('users')->select('name', 'email', 'id', 'created_at', 'updated_at')->get();
    return new UserCollection($users);
});

Route::put('/userscollectionupdate/{id}', 'UserController@update');
