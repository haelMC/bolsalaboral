<?php

use App\Http\Controllers\JobofferController;
use App\Http\Livewire\CrudGraduate;
use App\Http\Livewire\CrudGraduatet;
use App\Http\Livewire\CrudInstitution;
use App\Http\Livewire\CrudMonitoring;
use App\Http\Livewire\CrudCompanie;
use App\Http\Livewire\CrudMonitoringDetail;
use App\Http\Livewire\CrudPostulation;
use App\Http\Livewire\CrudTeacher;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\CrudJoboffer;
use App\Http\Livewire\JobofferLivewire;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminUserController; // Controlador de Admin
use App\Http\Livewire\UserRoleTables;

// Ruta de bienvenida
Route::get('/', function () {
    return view('welcome');
});

// Rutas protegidas por autenticación, verificación y el middleware `check.status`
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'check.status' // Aquí aplicamos el middleware para verificar el estado del usuario
])->group(function () {
    // Rutas protegidas
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Otras rutas protegidas por `check.status`
    Route::get('/teacher', CrudTeacher::class)->name('teachers');
    Route::get('/graduate', CrudGraduate::class)->name('graduates');
    Route::get('/companie', CrudCompanie::class)->name('companies');
    Route::get('/postulations', CrudPostulation::class)->name('postulations');
    Route::get('/graduatet', CrudGraduatet::class)->name('graduatet');
    Route::get('/joboffers', JobofferLivewire::class)->name('joboffers');
    Route::get('/joboffersc', CrudJoboffer::class)->name('joboffersc');
    Route::get('/monitoring', CrudMonitoring::class)->name('monitorings');
    Route::get('/monitoringdetail', CrudMonitoringDetail::class)->name('monitoringdetail');


    // Rutas del administrador para aprobar usuarios
    Route::middleware(['auth', 'role:admin,empresa'])->group(function () {
    Route::get('/pending-users', [AdminUserController::class, 'pendingUsers'])->name('pending-users');
    });
    Route::post('/admin/approve-user/{id}', [AdminUserController::class, 'approveUser'])->name('admin.approve-user');
});

// Otras rutas que no necesitan verificación de status
Route::get('joboffer/{joboffer}', [JobofferController::class, 'show'])->name('joboffers.show');
Route::get('category/{category}', [JobofferController::class, 'search'])->name('joboffers.search');

// Rutas de usuario y roles
Route::resource('users', UserController::class);
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::post('/users/{id}/assign-role', [UserController::class, 'assignRole'])->name('users.assignRole');

// Ruta para la página de aprobación pendiente
Route::get('/pending-approval', function () {
    return view('auth.pending-approval'); // Esta es la ruta a tu vista blade
})->name('pending.approval');

Route::get('/usuarios-empresas', UserRoleTables::class)->name('usuarios-empresas');

Route::get('/send-test-mail', function () {
    $user = App\Models\User::find(13); // Cambia esto por el ID de un usuario válido
    $user->notify(new App\Notifications\UsuarioAprobado());
    return 'Correo de prueba enviado!';
});


Route::get('/home', function () {
    return view('dashboard'); // o cualquier vista a la que quieras redirigir
})->name('home');
