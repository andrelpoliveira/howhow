<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgenciaController;
use App\Http\Controllers\CampanhaController;
use App\Http\Controllers\MarcaController;
use Laravel\Jetstream\Http\Controllers\Livewire\UserProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\DashboardAdmin;
use App\Http\Livewire\DashboardMarca;
use BaconQrCode\Renderer\Color\Rgb;

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
/* User */


/* Admin group */
Route::middleware('admin:admin')->group(function(){
    Route::get('admin/login',[AdminController::class,'adminLogin']); //Rota para acesso a pag da web
    Route::post('admin/login',[AdminController::class, 'store'])->name('admin.login'); //Rota para verificação do acesso

    //rotas para criação de um influencer
    Route::post('admin/dashboard',[DashboardAdmin::class, 'createInfluencer'])->name('admin.registerinfluencer');

    //rotas para criação de uma agência
    Route::post('admin/dashboard',[DashboardAdmin::class, 'createAgencia'])->name('admin.registeragencia');

    //rotas para criação de uma marca
    Route::post('admin/dashboard',[DashboardAdmin::class, 'createMarca'])->name('admin.registermarca');

});

/* Agencia group */
Route::middleware('agencia:agencia')->group(function(){
    Route::get('agencia/login',[AgenciaController::class,'agenciaLogin']);
    Route::post('agencia/login',[AgenciaController::class, 'store'])->name('agencia.login');
    Route::get('agencia/register',[AgenciaController::class, 'agenciaregister'])->name('agencia.register');
    Route::post('agencia/register',[AgenciaController::class, 'createAgencia'])->name('register.agencia');
});

/* Marca group */
Route::middleware('marca:marca')->group(function(){
    Route::get('marca',[MarcaController::class,'marca']);
    Route::get('marca/login',[MarcaController::class,'marcaLogin']);
    Route::post('marca/login',[MarcaController::class, 'store'])->name('marca.login');
    Route::get('marca/register',[MarcaController::class, 'marcaregister'])->name('marca.register');
    Route::post('marca/register',[MarcaController::class, 'createMarca'])->name('register.marca');
/*Campanha*/
    Route::get('marca/campanha', [CampanhaController::class, 'insertform'])->name('campanhas.create');
    Route::post('marca/campanhas/create', [CampanhaController::class, 'insert'])->name('campanhas.store');
});

/*   Middlewares */
Route::middleware([
    'auth:sanctum, web',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard')->middleware('auth:web');
    Route::get('/user/profile', [UserProfileController::class, 'show'])->name('profile.show');
});

/* Admin */
Route::middleware([
    'auth:sanctum,admin',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('livewire.Admin.dashboard-admin');
    })->name('admin.dashboard')->middleware('auth:admin');
    Route::get('/user/profile', [UserProfileController::class, 'show'])->name('profile.show');
});

/* Rota agencia */
Route::middleware(['auth:sanctum,agencia',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/agencia/dashboard', function () {
        return view('livewire.Agencia.dashboard-agencia');
    })->name('agencia.dashboard')->middleware('auth:agencia');
});

/* Rota marca */
Route::middleware(['auth:sanctum,marca', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/marca/dashboard', [CampanhaController::class, 'render'], function () {
        return view('livewire.Marca.dashboard-marca');
    })->name('marca.dashboard')->middleware('auth:marca');
    Route::get('/user/profile', [UserProfileController::class, 'show'])->name('profile.show');
    Route::get('marca/campanha', [CampanhaController::class, 'insertform'])->name('campanhas.create')->middleware('auth:marca');
    Route::post('marca/campanhas/create', [CampanhaController::class, 'insert'])->name('campanhas.store')->middleware('auth:marca');
});
/* End Middlewares*/

