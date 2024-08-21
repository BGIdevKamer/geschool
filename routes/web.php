<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\FormationController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\pant;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profil', function () { return view('profil'); });
    Route::get('/Etudiant', function () { return view('EnregistrementEtudiant'); })->name('Enregistrement.Etudiant');
    Route::get('/Formations', function () { return view('EnregistrementFormation'); })->name('Enregistrement.Formation');
    Route::get('/Liste-Formations',[FormationController::class,'ListeFormation'])->name('liste.Formation');
    Route::post('/update-info',[ProfileController::class,'updateInfo'])->name('update.info');
    Route::post('/update-formation',[FormationController::class,'updateformation'])->name('update.formation');
    Route::post('/add-formation',[FormationController::class,'addFormation'])->name('add.formation');
    Route::get('/delete-formation/{id}/{statut}',[FormationController::class,'DeleteFormation'])->name('Delete.Formation');
});

Route::middleware(['auth', 'plant:standard'])->group(function () {
});

Route::middleware(['auth', 'plant:premium'])->group(function () {
});


require __DIR__.'/auth.php';
