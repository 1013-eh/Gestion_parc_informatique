<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\MaterielController;
use App\Http\Controllers\FamilleController;
use App\Http\Controllers\SousFamilleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/materiels', [MaterielController::class, 'index'])->name('materiels.index');
    Route::get('/materiels/create', [MaterielController::class, 'create'])->name('materiels.create');
    Route::post('/materiels', [MaterielController::class, 'store'])->name('materiels.store');

    Route::get('/materiels/export', [MaterielController::class, 'export'])->name('materiels.export');
    Route::get('/materiels/import/template', [MaterielController::class, 'downloadTemplate'])->name('materiels.import.template');
    Route::get('/materiels/import', [MaterielController::class, 'showImportForm'])->name('materiels.import.form');
    Route::post('/materiels/import', [MaterielController::class, 'import'])->name('materiels.import.store');

    Route::get('/materiels/{materiel}/edit', [MaterielController::class, 'edit'])->name('materiels.edit');
    Route::patch('/materiels/{materiel}', [MaterielController::class, 'update'])->name('materiels.update');

    Route::get('/api/sous-familles/{famille}', [MaterielController::class, 'getSousFamilles'])->name('api.sous-familles');
    Route::get('/api/marques/{sousFamille}', [MaterielController::class, 'getMarques'])->name('api.marques');
    Route::get('/api/modeles/{marque}', [MaterielController::class, 'getModeles'])->name('api.modeles');
});

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/archive/create/{num_serie}', [ArchiveController::class, 'createForm'])->name('archive.createForm');
Route::resource('archive', ArchiveController::class);

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function(){
    Route::resource('familles', FamilleController::class);
    Route::resource('sous_familles', SousFamilleController::class);
});

require __DIR__.'/auth.php';
