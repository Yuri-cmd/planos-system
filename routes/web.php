<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportesController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/', [AuthController::class, 'showLoginForm']);
Route::post('inicio', [AuthController::class, 'login'])->name('inicio');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('reset-password', [AuthController::class, 'resetPass'])->name('resetPass');
Route::post('change-pass', [AuthController::class, 'validarUsuario'])->name('validarUsuario');
Route::post('savePass', [AuthController::class, 'savePass'])->name('savePass');

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/insertar-datos', [DashboardController::class, 'insertarDatos']);
Route::post('saveComprador', [DashboardController::class, 'saveComprador'])->name('saveComprador');
Route::post('getComprador', [DashboardController::class, 'getComprador'])->name('getComprador');
Route::post('saveColor', [DashboardController::class, 'saveColor'])->name('saveColor');
Route::get('getEstados', [DashboardController::class, 'getEstados'])->name('getEstados');
Route::get('getCuentas', [DashboardController::class, 'getCuentas'])->name('getCuentas');
Route::post('saveVenta', [DashboardController::class, 'saveVenta'])->name('saveVenta');
Route::get('getVenta', [DashboardController::class, 'getVenta'])->name('getVenta');
Route::post('getStatusTienda', [DashboardController::class, 'getStatusTienda'])->name('getStatusTienda');

// Clientes
Route::get('admin/clientes', [DashboardController::class, 'clientes'])->name('clientes');
Route::get('getClientes', [DashboardController::class, 'getClientes'])->name('getClientes');
Route::post('saveCliente', [DashboardController::class, 'saveCliente'])->name('saveCliente');
Route::post('deleteCliente', [DashboardController::class, 'deleteCliente'])->name('deleteCliente');
Route::post('actualizarCliente', [DashboardController::class, 'actualizarCliente'])->name('actualizarCliente');

// Usuarios
Route::get('admin/usuarios', [DashboardController::class, 'usuarios'])->name('usuarios');
Route::get('getUsuarios', [DashboardController::class, 'getUsuarios'])->name('getUsuarios');
Route::post('saveUsuario', [DashboardController::class, 'saveUsuario'])->name('saveUsuario');
Route::post('deleteUsuario', [DashboardController::class, 'deleteUsuario'])->name('deleteUsuario');
Route::post('actualizarUsuario', [DashboardController::class, 'actualizarUsuario'])->name('actualizarUsuario');

//reporte
Route::get('admin/tiendas', [ReportesController::class, 'viewTienda'])->name('viewTienda');
Route::get('admin/ventas/reservas', [ReportesController::class, 'viewVentas'])->name('viewVentas');
Route::get('admin/ventas', [ReportesController::class, 'viewVentasR'])->name('viewVentasR');