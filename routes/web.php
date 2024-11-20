<?php

use App\Http\Controllers\CashLoanController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeLoanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('clients/{client}/cash-loan', [CashLoanController::class, 'store'])->name('cash-loans.store');
    Route::put('clients/{client}/cash-loan', [CashLoanController::class, 'update'])->name('cash-loans.update');

    Route::post('clients/{client}/home-loan', [HomeLoanController::class, 'store'])->name('home-loans.store');
    Route::put('clients/{client}/home-loan', [HomeLoanController::class, 'update'])->name('home-loans.update');

    Route::resource('clients', ClientController::class);

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/export', [ReportController::class, 'export'])->name('reports.export');

});

require __DIR__.'/auth.php';
