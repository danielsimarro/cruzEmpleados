<?php

use Illuminate\Support\Facades\Route;
//Con los espacios de nombres indicamos donde se encuentran
//los archivos
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\PuestoController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\ImagenController;


//Ruta que nos muestra el inicio de nuestra pagina web
Route::get('/', [IndexController::class, 'index'])->name('index');

Route::resource('resource', ResourceController::class);

//Ruta que nos muestra la pagina de error en caso de que la ruta no exista
Route::fallback([IndexController::class, 'error404'])->name('404');

//Ruta que nos lleva a los controladores de las tablas
//Controladores de puesto
Route::resource('puesto', PuestoController::class);
//Controladores de departamento
Route::resource('departamento', DepartamentoController::class);
//Controladores de departamento
Route::resource('trabajador', TrabajadorController::class);
//Controladores de imagen
Route::resource('imagen', ImagenController::class);

Route::post('imagen/{imagen}', [ImagenController::class, 'upload'])->name('imagen.upload');

