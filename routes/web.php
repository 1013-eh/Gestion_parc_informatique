<?php

use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\CentreController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\FamilleController;
use App\Http\Controllers\MarqueController;
use App\Http\Controllers\MaterielController;
use App\Http\Controllers\ModeleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\RegionsCentresController;
use App\Http\Controllers\SousFamilleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Première connexion
    Route::get('/change-password', [ChangePasswordController::class, 'show'])->name('change.password');
    Route::post('/change-password', [ChangePasswordController::class, 'update'])->name('change.password.update');

    // Utilisateurs
    Route::resource('users', UserController::class);

    // Matériels
    Route::resource('materiels', MaterielController::class);

    // Régions
    Route::resource('regions', RegionController::class);

    // Centres
    Route::resource('centres', CentreController::class);

    // Vue régions / centres
    Route::get('/regions-centres', [RegionsCentresController::class, 'index'])
        ->name('regions_centres.index');
});

// Archives
Route::get('/archive/create/{num_serie}', [ArchiveController::class, 'createForm'])
    ->name('archive.createForm');
Route::resource('archive', ArchiveController::class);

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Familles
    Route::resource('familles', FamilleController::class);

    // Sous-familles
    Route::resource('sous_familles', SousFamilleController::class);

    // Marques
    Route::resource('marques', MarqueController::class);

    // Modèles
    Route::resource('modeles', ModeleController::class);
});

// API AJAX
Route::get('familles/{id}/sous_familles', function ($id) {
    return response()->json(
        \App\Models\SousFamille::where('id_famille', $id)->get()
    );
})->name('admin.familles.sous_familles');

Route::get('sous_familles/{id}/marques', function ($id) {
    return response()->json(
        \App\Models\Marque::where('id_sous_famille', $id)->get()
    );
})->name('admin.sous_familles.marques');

require __DIR__ . '/auth.php';
