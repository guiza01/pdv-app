<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VendaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos');
    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes');
    Route::get('/pagamento', [PagamentoController::class, 'index'])->name('pagamento');
    Route::get('/venda', [VendaController::class, 'index'])->name('venda');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
