<?php

use Illuminate\Http\Request;

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

// Se valida si se envia como header el valor de Content-Type
Route::group(['middleware' => ['validate.header']], function() {
  Route::post('/login', 'UserController@authenticate');

  // Validar el token jwt de las rutas
  Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('/users', 'UserController@register');
    Route::get('/users/{id}', 'UserController@listarUsuario');
    Route::get('/users', 'UserController@listarTodosUsuarios');
    Route::put('/users/{id}', 'UserController@editar');
    Route::delete('/users/{id}', 'UserController@eliminar');
  });

  Route::get('{anything}', 'UserController@error404');
  Route::get('{anything}/{id}', 'UserController@error404');
});
