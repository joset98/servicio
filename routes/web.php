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

Route::get('/home', 'HomeController@index')->name('home');


// Rutas Usuarios
Route::group([ 'namespace' => 'Users','middleware' => ['auth']], function () {
    Route::resource('users', 'UsersController');
});


Auth::routes();

// Redirige al home(dashboard)
Route::get('/', function(){
	return Redirect::route('home');
})->name('homeredirection');

// Permite cerrar sesion en caso que ingrese la url directamente
Route::get('/logout',function(){
	Auth::logout();
   return redirect('/');
})->name('logout-guest');

// Deniega el acceso al registro de usuarios
Route::get('/register',function(){
   return redirect('/');
})->name('register')->middleware('guest');


// Rutas Tareas
Route::group(['namespace' => 'Tasks','middleware' => ['auth']], function () {
    Route::resource('tasks', 'TasksController');
     Route::get('tasks/createsubmit/{id_client}', 'TasksController@createsubmit')->name('tasks.createsubmit');
});

// Rutas Clientes
Route::group(['namespace' => 'Clients','middleware' => ['auth']], function () {
    Route::resource('clients', 'ClientController');
});

// Rutas Settings
Route::group(['prefix' => 'settings', 'namespace' => 'Settings','middleware' => ['auth']], function () {

    //Instituciones
    Route::resource('institution', 'InstitutionController')->only(["index",'edit',"update"]);

    //Roles
    Route::resource( 'roles','RolesController')->only(["index", "store"]);
});

// Rutas profile
Route::group(['prefix' => 'profile', 'namespace' => 'Profile','middleware' => ['auth']], function () {
    Route::get('', 'PerfilController@index')->name('perfil.index');
    Route::get('edit', 'PerfilController@edit')->name('perfil.edit');
    Route::put('update', 'PerfilController@update')->name('perfil.update');
    Route::get('editPassword', 'PerfilController@editPassword')->name('perfil.edit.password');
    Route::put('updatePassword', 'PerfilController@updatePassword')->name('perfil.password.update');
});

