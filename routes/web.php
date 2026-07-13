<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FamilleController;
use App\Http\Controllers\SousFamilleController;
use App\Http\Controllers\MarqueController;
use App\Http\Controllers\ModeleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChangePasswordController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Changer mot de passe première connexion
    Route::get('/change-password', [ChangePasswordController::class, 'show'])->name('change.password');
    Route::post('/change-password', [ChangePasswordController::class, 'update'])->name('change.password.update');

    // Users
    Route::resource('users', UserController::class);

});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('familles', FamilleController::class);
    Route::resource('sous_familles', SousFamilleController::class);
    Route::resource('marques', MarqueController::class);
    Route::resource('modeles', ModeleController::class);
});

Route::get('familles/{id}/sous_familles', function($id) {
    $sousFamilles = \App\Models\SousFamille::where('id_famille', $id)->get();
    return response()->json($sousFamilles);
})->name('admin.familles.sous_familles');

Route::get('sous_familles/{id}/marques', function($id) {
    $marques = \App\Models\Marque::where('id_sous_famille', $id)->get();
    return response()->json($marques);
})->name('admin.sous_familles.marques');

require __DIR__ . '/auth.php';