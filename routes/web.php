<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FamilleController;
use App\Http\Controllers\SousFamilleController;
use App\Http\Controllers\MarqueController;
use App\Http\Controllers\ModeleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return redirect()->route('users.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
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
Route::resource('users', UserController::class);
