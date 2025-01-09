<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PDFController;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
Route::get('/', [WelcomeController::class, 'index'])->name("home");
Route::get('modalidades/{product}', [ProductController::class, 'modalidades'])->name("modalidades");


Route::get('generar-pdf/{product}', [PDFController::class, 'generarPDF'])->name("generarpdf");
Route::get('imprimir/modalidad/{modalidad}', [PDFController::class, 'modalidad_pdf'])->name("generarmodalidadpdf");

Route::get('/descargar/{nombre}/{formato}', function ($nombre,$formato) {
    $filePath = storage_path("app\\public\\tones\\$nombre.$formato");
    // dd($filePath);
    if (!file_exists($filePath)) {
        abort(404, 'El archivo no existe.');
    }
    return response()->download($filePath, "tonocalamar.$formato");
})->name('descargar');