<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AnuncioController;
use App\Http\Controllers\OfertaController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployedController;
use App\Http\Controllers\UserController;
use PHPUnit\TextUI\XmlConfiguration\Group;
use App\Http\Middleware\IsLocked;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsEmployed;
use App\Http\Middleware\IsNotEmployed;
use Illuminate\Support\Facades\Auth;

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

//lista de anuncios
Route::get('/anuncios', [AnuncioController::class, 'index'])
->name('anuncios.index');
  
//PARA BUSCAR anuncios
Route::match(['GET','POST'], '/anuncios/search',[AnuncioController::class, 'search'])
    ->name('anuncios.search');

//grupo de rutas a las que le aplicaremos un middleware
// Route::group(['auth', 'middleware'=>IsLocked::class], function(){
    Route::group( function(){
    
    //formulario de creación de anuncios
    Route::get('/anuncios/create', [AnuncioController::class, 'create'])
    ->name('anuncios.create')->middleware('auth','is_not_employed');
    
    //guardar el anuncio
    Route::get('/anuncios', [AnuncioController::class, 'store'])
    ->name('anuncios.store');
    
    //eliminación definitiva del anuncio
    //URL firmada para más seguridad
    Route::delete('anuncios/purge', [AnuncioController::class, 'purge'])
    ->name('anuncios.purge');
    //     ->middleware('signed'); //para asignar firma a la URL
    
    //eliminación con soft deletes
    Route::delete('anuncios', [AnuncioController::class, 'destroy'])
    ->name('anuncios.destroy');
    
    
    //formulario de edición
    Route::get('/anuncios/{anuncio}/edit', [AnuncioController::class, 'edit'])
    ->name('anuncios.edit');
    
    //restauración del anuncio
    Route::get('/anuncios/{anuncio}/restore', [AnuncioController::class, 'restore'])
    ->name('anuncios.restore');
    
    //RUTA PARA LA CONFIRMACIÓN DE BORRADO CON SOFT DELETES
    Route::get('anuncios/{anuncio}/delete', [AnuncioController::class, 'delete'])
    ->name('anuncios.delete');
    
    //RUTA PARA LA CONFIRMACIÓN DE ELIMINACIÓN DEFINITIVA
    Route::get('anuncios/{anuncio}/remove', [AnuncioController::class, 'remove'])
    ->name('anuncios.remove');
    
    //actualizar anuncio
    Route::match(['PUT','PATCH'], '/anuncios/{anuncio}',[AnuncioController::class, 'update'])
    ->name('anuncios.update');
});

//detalles del anuncio
Route::get('anuncios/{anuncio}', [AnuncioController::class, 'show'])
    ->name('anuncios.show');

    
    
//CRUD DE OFERTAS

//Rutas??


//RUTAS PARA LA GESTIÓN DE USUARIOS
Auth::routes();

//añadir verificación a las rutas
Auth::routes(['verify'=>true]);

//ruta para home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//RUTA DE USUARIOS BLOQUEADOS
Route::get('/bloqueado', [UserController::class, 'locked'])->name('user.locked');

//RUTA PARA CONTACTO
//ruta para el formulario de contacto
Route::get('/contacto', [ContactoController::class, 'index'])
->name('contacto');

//ruta para el envío del email de contacto
Route::post('/contacto', [ContactoController::class, 'send'])
->name('contacto.email');

//RUTAS PARA LOS EMPLEADOS
//llevarán el prefijo employed para identificación de rutas
Route::prefix('employed')->middleware('auth', 'is_employed')->group(function(){
    
    //ver los anuncios eliminados (/employed/deleteAnuncios)
    Route::get('deletedAnuncios', [EmployedController::class, 'deletedAnuncios'])->name('employed.deleted.anuncios');
});

//RUTAS PARA EL ADMINISTRADOR
//llevarán el prefijo admin para identificación de rutas
Route::prefix('admin')->middleware('auth', 'is_admin')->group(function(){
    
    //ver los usuarios bloqueados (/admin/lockedUsers)
    Route::get('/lockedUsers', [AdminController::class, 'lockedUsers'])->name('admin.locked.users');
    
    //detalles de un usuario
    Route::get('usuario/{user}/detalles', [AdminController::class, 'userShow'])
        ->name('admin.user.show');
    
    //listado de usuarios
    Route::get('usuarios', [AdminController::class, 'userList'])
        ->name('admin.users');
    
    //búsqueda de usuarios
    Route::get('usuario/buscar', [AdminController::class, 'userSearch'])
        ->name('admin.users.search');
    
    //añadir rol
    Route::post('rol', [AdminController::class, 'setRol'])
        ->name('admin.user.setRol');
    
    //quitar un rol
    Route::delete('rol', [AdminController::class, 'removeRol'])
        ->name('admin.user.removeRol');    
});

//RUTA DE FALLBACK
Route::fallback([WelcomeController::class, 'index']);  