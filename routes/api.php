<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;
//use Laravel\Sanctum\Http\Controllers\AuthenticatedSessionController;

// rutas inciales para registrarse y logearse com ousuario 
Route::post('/auth/register', 'App\Http\Controllers\AuthController@create');
Route::post('/auth/login1', 'App\Http\Controllers\AuthController@login');

// Rutas para las tareas usamo un middleware
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/tasks', 'App\Http\Controllers\TaskController@index'); // Listar todas las tareas
    Route::post('/tasks', 'App\Http\Controllers\TaskController@store'); // Crear una nueva tarea
    // Route::get('/tasks/{task}', 'TaskController@show'); // Mostrar detalles de una tarea específica
    Route::put('/tasks/{task}', 'App\Http\Controllers\TaskController@update'); // Actualizar una tarea
    // Route::delete('/tasks/{task}', 'TaskController@delete'); // Eliminar una tarea
Route::post('/auth/logout1', 'App\Http\Controllers\AuthController@loguot');
});
 