<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
/*    
return [
        'par1' => 'val1',
        'par2' => 'val2',
    ];
    */
    return view('welcome');
});

Route::get('/route1', [TestController::class, 'index']);
Route::post('/route2', [TestController::class, 'save']);

//lista utenti
Route::get('/users', [UserController::class, 'index']);
//creazione utente
Route::get('/users/create', [UserController::class, 'create']);
Route::post('users/create', [UserController::class, 'save']);
//modifica utenti
Route::get('/users/update/{id}', [UserController::class, 'update']);
Route::post('/users/update/{id}', [UserController::class, 'saveUpdate']);

Route::delete('/users/delete/{id}', [UserController::class, 'delete']);




