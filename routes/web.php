<?php

use App\Http\Controllers\Auth\FacebookController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\EntidadController;
use App\Http\Controllers\IdeaProyectoController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\CiudadController;
use App\Http\Controllers\MapaController;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/video/{video}', [VideoController::class, 'index'])->name('video.ver');
Route::get('/equipo', [AutorController::class, 'team'])->name('team');
Route::get('/mapa',[MapaController::class, 'index'])->name('mapa');
Route::get('/mapa/proyectos',[MapaController::class, 'getproyectos'])->name('getproyectos');
Route::post('/like',[MapaController::class, 'like']);
Route::get('/autor/{autor}/', [AutorController::class, 'getAutorCompleted'])->name('autor.get');
Route::get('/post/{proyecto}', [IdeaProyectoController::class, 'post'])->name('post')->middleware('isPublished');

Route::get('/facebook-login', [FacebookController::class, 'login'])->name('facebook.login');
Route::get('/facebook-callback', [FacebookController::class, 'callback'])->name('facebook.callback');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/registro/new', [IdeaProyectoController::class, 'new'])->name('registro.new');
    Route::get('/registro/{registro}/editar', [IdeaProyectoController::class, 'edit'])->name('registro.edit');
    Route::post('/registro/{registro}/update', [IdeaProyectoController::class, 'update'])->name('registro.update');
    Route::post('registro/crear', [IdeaProyectoController::class, 'crear'])->name('registro.crear');
    Route::get('registros', [IdeaProyectoController::class, 'dataLista'])->name('registros.table');
    
    Route::post('/documento/{registro}/registro', [DocumentoController::class, 'upload'])->name('documento.upload');
    Route::get('/documento/{documento}', [DocumentoController::class, 'getdocumento'])->name('documento.get');
    Route::post('/documento/{documento}/delete', [DocumentoController::class, 'delete'])->name('documento.remove');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/avatar/{user}', [ProfileController::class, 'getAvatar'])->name('profile.get.avatar');
    Route::post('/profile/avatar/{user}', [ProfileController::class, 'setAvatar'])->name('profile.set.avatar');
    
    Route::get('/pais/{code}/ciudades/', [CiudadController::class, 'getCiudadesPorCodePais'])->name('pais.ciudades');

    Route::get('/proyectos/list', [IdeaProyectoController::class, 'index'])->name('proyectos.list');

});

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/users/list', [AdminController::class, 'usuarios'])->name('users.list');
    Route::get('/users/datatable', [AdminController::class, 'dataListaUsers'])->name('users.table');
    Route::get('/users/store', [AdminController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [AdminController::class, 'edit'])->name('users.edit');
    Route::post('/users/create', [AdminController::class, 'create'])->name('users.create');
    Route::post('/users/{user}/update', [AdminController::class, 'update'])->name('users.update');
    Route::post('/user/delete', [AdminController::class, 'delete'])->name('user.delete');
    
    Route::get('/videos/list', [VideoController::class, 'list'])->name('video.list');
    Route::get('/videos', [VideoController::class, 'dataLista'])->name('videos.table');
    Route::get('/videos/crear', [VideoController::class, 'create'])->name('video.crear');
    Route::get('/video/{video}/edit', [VideoController::class, 'edit'])->name('video.edit');
    Route::post('/video/store', [VideoController::class, 'store'])->name('video.store');
    Route::post('/video/{video}/update', [VideoController::class, 'update'])->name('video.update');
    Route::post('/video/delete', [VideoController::class, 'delete'])->name('video.delete');

    Route::get('/entidades/list', [EntidadController::class, 'index'])->name('entidad.list');
    Route::get('/entidades', [EntidadController::class, 'dataLista'])->name('entidades.table');
    Route::get('/entidad/crear', [EntidadController::class, 'create'])->name('entidad.crear');
    Route::get('/entidad/{entidad}/edit', [EntidadController::class, 'edit'])->name('entidad.edit');
    Route::post('/entidad/store', [EntidadController::class, 'store'])->name('entidad.store');
    Route::post('/entidad/{entidad}/update', [EntidadController::class, 'update'])->name('entidad.update');
    Route::post('/entidad/delete', [EntidadController::class, 'delete'])->name('entidad.delete');
});

// Route::get('/videos/crear', [VideoController::class, 'create'])->name('video.crear');

require __DIR__.'/auth.php';
