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
use Illuminate\Support\Facades\Redirect;
use App\SidebarMenu;


//RUTAS DE AUTENTIFICACIÓN
Auth::routes(['register' => false]);

//RUTA DE INICIO
Route::get('/', function () {
	if (!Auth::check()) 
	{
		return Redirect(Route('login'));
	} else 
	{
		return Redirect(Route('inicio'));
	}
});

Route::get('/inicio', function () {
	return view('home');
})->name('inicio');


/*
*	RUTAS DE ACCESO PARA: ADMINISTRADOR
*/


//Usuarios
Route::resource('user', 'Admin\UserController', ['names' => [
	'index' 	=> 'admin.user.index',
	'create' 	=> 'admin.user.create',
	'store' 	=> 'admin.user.store',
	'destroy' 	=> 'admin.user.destroy',
	'show' 		=> 'admin.user.show',
	'edit' 		=> 'admin.user.edit',
	'update' 	=> 'admin.user.update',
]]);
Route::put('user/change-password/{user}', 'Admin\UserController@changePassword')->name('admin.user.changepassword');



Route::get('/prueba', function () {
	dd(datatables()->eloquent(App\User::query())->toJson());
	return datatables()->eloquent(App\User::query())->toJson();
});

