<?php

use Illuminate\Support\Facades\Route;

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

//RUTA PARA LA PORTADA (index)
Route::get('/', [WelcomeController::class]);

//CRUD DE ANUNCIOS
Route::resource('anuncios', AnuncioController::class);

//RUTA PARA LA CONFIRMACIÓN DE ELIMINACIÓN
Route::get('anuncios/{anuncio}/borrar', [AnuncioController::class])->name('anuncios.borrar');

//CRUD DE OFERTAS
Route::resource('ofertas', OfertaController::class);

//RUTA PARA LA CONFIRMACIÓN DE ELIMINACIÓN
Route::get('ofertas/{oferta}/borrar', [OfertaController::class])->name('ofertas.borrar');