<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AutoController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartaController;
use App\Http\Controllers\CodigoController;

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

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::get('/',[PageController::class,'home'])->name('home');
Route::get('/auto/{autos:slug}',[PageController::class,'auto'])->name('auto');
Route::resource('/users',UserController::class)->middleware('auth');


Route::resource('/menus',MenuController::class)->middleware('auth');
Route::get('/descargar-qr-carta-digital/{menu}', [PdfController::class,'descargar_carta_qr'])->name('pdf.descargar-qr-carta-digital');
Route::get('generateQr/{menu}',[MenuController::class,'generateQrCode'])->name('menus.generateQrCode');


Route::get('/generar-qr', [MenuController::class,'generar_qr'])->name('menus.generar-qr'); // ruta del formulario para generar el codigo qr
Route::post('/generar-qr-carta-digital', [MenuController::class,'generar_qr_carta'])->name('menus.generar-qr-carta-digital');//funcion que deriva desde el jquery, recibe y envia el qr




Route::resource('autos',AutoController::class)->middleware('auth');
Route::resource('cartas',CartaController::class)->middleware('auth');
Route::get('/cartas-digitales/generate-qr/{carta}',[CartaController::class,'generar_codigo_qr'])->name('cartas.generar-codigo-qr');
Route::get('/cartas-digitales/documentos/{slug}',[CartaController::class, 'validar_codigo_qr'])->name('cartas.validar-codigo-qr');

Route::resource('codigos',CodigoController::class)->middleware('auth');


Route::get('/generate-storage-link', function () {
    Artisan::call('storage:link');
    return 'Enlace simbólico para el almacenamiento creado correctamente.';
});

require __DIR__.'/auth.php';
