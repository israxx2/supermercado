<?php

use Illuminate\Http\Request;
use App\User;
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

Route::get('user/getdata', function (Request $request){
	if($request->ajax())
	{
		$users = User::with('role')->get();
		return Datatables()->collection($users)->make(true);
	} else return [];
})->name('api.user.getdata');

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
