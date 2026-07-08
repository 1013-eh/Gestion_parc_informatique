<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\MaterielController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Materials Routes :
Route::get('/materiels', [MaterielController::class, 'index'])->name('materiels.index');
Route::get('/materiels/create', [MaterielController::class, 'create'])->name('materiels.create');
Route::post('/materiels', [MaterielController::class, 'store'])->name('materiels.store');

// For modifications :
Route::get('/materiels/{materiel}/edit', [MaterielController::class, 'edit'])->name('materiels.edit');
Route::patch('/materiels/{materiel}', [MaterielController::class, 'update'])->name('materiels.update');

// End Of Materials Routes :

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('archive', ArchiveController::class);

require __DIR__.'/auth.php';