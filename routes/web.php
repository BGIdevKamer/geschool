<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\participantController;
use App\Http\Controllers\PayementController;
use App\Http\Controllers\ExerciceController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\AuthController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [FormationController::class, 'welcome']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/Participant-login', function () {
    return view('participant.auth.login');
})->name('Participant.login');

Route::get('/Participant-register', function () {
    return view('participant.auth.register');
})->name('Participant.register');

Route::post('/register-participant', [AuthController::class, 'registerParticipant'])->name('register.participant');

Route::get('/Inscription/{keys}', [AuthController::class, 'inscription'])->name('inscription');

Route::get('/Login-Participant', [AuthController::class, 'Login'])->name('Login.Participant');

Route::prefix('participant')->middleware(['auth:participant'])->group(function () {

    Route::get('/dashboard', [AuthController::class, 'dashboardParticipant'])->name('participant.dashboard');

    Route::get('/Liste-Cours', [CoursController::class, 'ParticipantCours'])->name('Participant.Cours');
    Route::get('/Cour/{id}', [CoursController::class, 'ParticpantCour'])->name('particpant.cour');
    Route::get('/Exercice/{id}', [ExerciceController::class, 'ExerciceView'])->name('Exercice.View');
    Route::post('/Quiz', [ExerciceController::class, 'QuizForm'])->name('Quiz.Form');
});

Route::get('/download/{file}', [CoursController::class, 'download'])->name('download');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profil', function () {
        return view('profil');
    });

    Route::get('/Participant', [participantController::class, 'viewFormParticipant'])->name('Enregistrement.Etudiant');
    Route::get('/Formations', function () {
        return view('EnregistrementFormation');
    })->name('Enregistrement.Formation');

    Route::get('/Liste-Formations', [FormationController::class, 'ListeFormation'])->name('liste.Formation');
    Route::get('/Liste-particiapants', [participantController::class, 'Listeparticiapants'])->name('liste.particiapants');
    Route::post('/update-info', [ProfileController::class, 'updateInfo'])->name('update.info');
    Route::post('/update-formation', [FormationController::class, 'updateformation'])->name('update.formation');
    Route::post('/add-formation', [FormationController::class, 'addFormation'])->name('add.formation');
    Route::post('/add-participant', [participantController::class, 'addParticipant'])->name('add.participant');
    Route::post('/delete-participant', [participantController::class, 'deleteParticipant']);
    Route::post('/Update-participant', [participantController::class, 'UpdateParticipant'])->name('update.participant');
    Route::get('/delete-formation/{id}/{statut}', [FormationController::class, 'DeleteFormation'])->name('Delete.Formation');



    //         Online Ressource
    Route::get('/Cour', [CoursController::class, 'ViewCour'])->name('cour.index');
    Route::post('/add-cour', [CoursController::class, 'addCour'])->name('add.cour');
    Route::post('/add-pieces', [CoursController::class, 'addPieces'])->name('add.pieces');
    Route::get('/Liste-cours', [CoursController::class, 'ListeCours'])->name('Liste.cours');
    Route::get('/Vue-Cour/{id}', [CoursController::class, 'CourDetails'])->name('view.cour');
    Route::get('/Delete-cour/{id}', [CoursController::class, 'deleteCour'])->name('delete.cour');
    Route::get('/Exercices', [ExerciceController::class, 'Exercice'])->name('Exercice');
    Route::post('/add-Exercice', [ExerciceController::class, 'addExercice'])->name('add.Exercice');
    Route::post('/add-Question', [ExerciceController::class, 'addQuestion'])->name('add.Question');
    Route::post('/add-Choix', [ExerciceController::class, 'addChoix'])->name('add.Choix');
    Route::get('/Config-Exercices/{id}', [ExerciceController::class, 'ConfigExercices'])->name('Config.Exercices');

    Route::get('/Courriels', function () {
        return view('CourrielListe');
    })->name('courriel.liste');


    //payements 
    Route::get('/Payements', [PayementController::class, 'PayementIndex'])->name('Payement.index');
    Route::post('/ajouter-Payement', [PayementController::class, 'addPayement'])->name('add.payement');
    Route::get('/Recus', function () {
        return view('print.payement-recus');
    });
});

Route::middleware(['auth', 'plant:standard'])->group(function () {});

Route::middleware(['auth', 'plant:premium'])->group(function () {});


require __DIR__ . '/auth.php';
