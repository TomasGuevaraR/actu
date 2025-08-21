<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MiembroController;
use App\Http\Controllers\PerfilController;
use App\Http\Middleware\PreventBackHistory;
use App\Http\Controllers\UsuarioController;
use App\Models\Miembro;
use App\Http\Controllers\PresupuestoController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\EgresoController;
use App\Http\Controllers\DiezmoController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\ReporteController;


// -------------------------------
// RUTAS DE AUTENTICACIÓN PÚBLICAS
// -------------------------------
Route::get('/login', [LoginController::class, 'showLoginForm'])
    ->name('login')
    ->middleware('guest');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.attempt')
    ->middleware('guest');

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// Redirección raíz a login
Route::get('/', fn () => redirect()->route('login'));

// -------------------------------
// RUTAS PRIVADAS (Requieren Login)
// -------------------------------
Route::middleware(['auth', PreventBackHistory::class])->group(function () {

    // Dashboard
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

    // 📚 Libro Contable
    Route::get('/libro-contable', fn () => view('libro.index'))->name('libro-contable.index');
    Route::get('/libro', [LibroController::class, 'index'])->name('libro.index');
    Route::get('/movimientos/{id}/detalles', [MovimientoController::class, 'detalles']);


    // 💰 Presupuesto y Movimientos
    Route::get('/presupuesto', fn () => view('presupuestos.index'))->name('presupuesto.index');
    Route::resource('presupuestos', PresupuestoController::class);
    Route::resource('movimientos', MovimientoController::class);
    Route::get('/movimientos/{id}/detalles-ingreso', [MovimientoController::class, 'detallesIngreso']);
    Route::resource('ingresos', MovimientoController::class);

    // 📊 Estados Financieros
    Route::get('/estados', [EstadoController::class, 'index'])->name('estado.index');
    Route::get('/estado/saldo-inicial', [EstadoController::class, 'formSaldoInicial'])->name('estado.saldo-inicial.form');
    Route::post('/estado/saldo-inicial', [EstadoController::class, 'guardarSaldoInicial'])->name('estado.saldo-inicial.guardar');

    // 👥 Miembros
    Route::resource('miembros', MiembroController::class)->except(['show']);
    Route::get('/miembros-export', [MiembroController::class, 'export'])->name('miembros.export');
    Route::get('/miembros/exportar-csv', [MiembroController::class, 'exportCsv'])->name('miembros.export.csv');
    Route::get('/miembros/{id}', [MiembroController::class, 'show'])->name('miembros.show');

    // 👤 Usuarios
    Route::resource('usuarios', UsuarioController::class);
    Route::patch('/usuarios/{id}/toggle', [UsuarioController::class, 'toggle'])->name('usuarios.toggle');
    Route::get('/usuarios/{id}/json', [PerfilController::class, 'getUsuarioJson'])->name('usuarios.json');

    // 🙋‍♂ Perfil
    Route::get('/mi-perfil', function () {
        $usuario = Auth::user();
        $miembro = Miembro::where('numero_identificacion', $usuario->numero_identificacion)->first();
        return view('mi_perfil.index', compact('usuario', 'miembro'));
    })->name('mi-perfil.index');
    Route::put('/mi-perfil/actualizar', [PerfilController::class, 'update'])->name('mi-perfil.actualizar');
    Route::get('/mi-perfil/editar', [PerfilController::class, 'edit'])->name('mi-perfil.edit');
    Route::post('/mi-perfil/actualizar', [PerfilController::class, 'update'])->name('mi-perfil.update');

    // 📈 Reportes
    Route::get('/reporte', [ReporteController::class, 'index'])->name('reporte.index');
    Route::post('/reportes', [ReporteController::class, 'store'])->name('reportes.store');
    Route::delete('/reportes/{id}', [ReporteController::class, 'destroy'])->name('reportes.destroy');
    Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');
    Route::get('/reporte/diezmo', [ReporteController::class, 'diezmo'])->name('reporte.diezmo');
    Route::get('/reporte/diezmos/excel', [ReporteController::class, 'exportarCSV'])->name('reporte.diezmos.excel');

    // 💸 Egresos
    Route::get('/egresos/create', [EgresoController::class, 'create'])->name('egresos.create');
    Route::post('/egresos/store', [EgresoController::class, 'store'])->name('egresos.store');

    // 💵 Ingresos
    Route::get('/ingresos/create', [IngresoController::class, 'create'])->name('ingresos.create');
    Route::post('/ingresos/store', [IngresoController::class, 'store'])->name('ingresos.store');

    // ✝️ Diezmos y Ofrendas
    Route::resource('diezmo', DiezmoController::class);
    Route::get('/diezmo', [DiezmoController::class, 'index'])->name('diezmo.index');
    Route::post('/diezmo', [DiezmoController::class, 'store'])->name('diezmo.store');
});

// -------------------------------
// RUTAS GENERADAS AUTOMÁTICAMENTE
// -------------------------------
if (file_exists(__DIR__.'/auth.php')) {
    require __DIR__.'/auth.php';
}
