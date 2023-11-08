<?php

use App\Http\Controllers\HistorialClinicoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PacienteController;
use App\Models\historialClinico;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index2'])->name('home');

Route::get('/calendar', [App\Http\Controllers\HomeController::class, 'index'])->name('homeCalendar');

Auth::routes();

Route::get('/calendar', function () {
    return view('calendar');
})->name('homeCalendar')->middleware('auth');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RolController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('pacientes', PacienteController::class);

    Route::get('historialClinico', [HistorialClinicoController::class, 'index'])->name('historial_clinico.index');
    /*  Route::get('pacientes/historialClinico/{id}', [HistorialClinicoController::class, 'show'])->name('historial_clinico'); */
});
