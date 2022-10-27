<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AnuncioController;
use App\Http\Controllers\OfertaController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\AdminController;

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
Route::get('/', [WelcomeController::class, 'index'])->name('portada');


//CRUD DE ANUNCIOS

//PARA BUSCAR anuncios
Route::match(['GET','POST'], '/anuncios/search',[AnuncioController::class, 'search'])
->name('anuncios.search');

//eliminación definitiva del anuncio
//URL firmada para más seguridad
Route::delete('anuncios/purge', [AnuncioController::class, 'purge'])
    ->name('anuncios.purge')
    ->middleware('signed'); //para asignar firma a la URL

//eliminación con soft deletes
Route::delete('anuncios/{anuncio}', [AnuncioController::class, 'destroy'])
    ->name('anuncios.destroy');

//restauración del anuncio
Route::get('/anuncios/{anuncio}/restore', [AnuncioController::class, 'restore'])
->name('anuncios.restore');

//rutas del CRUD
Route::resource('anuncios', AnuncioController::class);

//RUTA PARA LA CONFIRMACIÓN DE BORRADO CON SOFT DELETES
Route::get('anuncios/{anuncio}/borrar', [AnuncioController::class, 'delete'])->name('anuncios.borrar');

//RUTA PARA LA CONFIRMACIÓN DE ELIMINACIÓN DEFINITIVA
Route::get('anuncios/{anuncio}/eliminar', [AnuncioController::class, 'remove'])->name('anuncios.eliminar');


//CRUD DE OFERTAS
Route::resource('ofertas', OfertaController::class);

//RUTA PARA LA CONFIRMACIÓN DE ELIMINACIÓN
Route::get('ofertas/{oferta}/borrar', [OfertaController::class, 'delete'])->name('ofertas.borrar');


//RUTAS PARA LA GESTIÓN DE USUARIOS
Auth::routes();

//añadir verificación a las rutas
Auth::routes(['verify'=>true]);

//ruta para home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//RUTA PARA CONTACTO
//ruta para el formulario de contacto
Route::get('/contacto', [ContactoController::class, 'index'])
->name('contacto');

//ruta para el envío del email de contacto
Route::post('/contacto', [ContactoController::class, 'send'])
->name('contacto.email');

//RUTAS PARA EL ADMINISTRADOR Y EDITOR
//llevarán el prefijo employed para identificación de rutas
Route::prefix('employed')->middleware('auth', 'is_admin')->group(function(){
    
//ver los anuncios eliminados (/admin/deleteAnuncios)
Route::get('deletedAnuncios', [AdminController::class, 'deletedAnuncios'])->name('admin.deleted.anuncios');
});

//TODO: crear ruta para gestión de usuarios bloqueados (solo para admin?)

//RUTA DE FALLBACK
Route::fallback([WelcomeController::class, 'index']);  