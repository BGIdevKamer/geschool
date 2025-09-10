<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\participantController;
use App\Http\Controllers\PayementController;
use App\Http\Controllers\ExerciceController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\CompositionController;
use App\Http\Controllers\BulletinController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\SalleController;
use App\Http\Controllers\EmploieController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\DataController;
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

// Route::get('/dashboard', function () {

//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/dashboard', [AuthController::class, 'dashboardVue'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/Participant-login', function () {
    return view('participant.auth.login');
})->name('Participant.login');

Route::get('/Participant-register', function () {
    return view('participant.auth.register');
})->name('Participant.register');

Route::post('/register-participant', [AuthController::class, 'registerParticipant'])->name('register.participant');

Route::get('/Inscription/{keys}', [AuthController::class, 'inscription'])->name('inscription');

Route::post('/Login-Participant', [AuthController::class, 'Login'])->name('Login.Participant');

Route::prefix('participant')->middleware(['auth:participant'])->group(function () {

    Route::get('/dashboard', [DataController::class, 'dashboardParticipant'])->name('participant.dashboard');

    Route::get('/Liste-Cours', [CoursController::class, 'ParticipantCours'])->name('Participant.Cours');
    Route::get('/Cour/{id}', [CoursController::class, 'ParticpantCour'])->name('particpant.cour');
    Route::post('/Quiz', [ExerciceController::class, 'QuizForm'])->name('Quiz.Form');
    Route::get('/Evaluations', [ExerciceController::class, 'EvaluationsParticipant'])->name('Evaluations.Participant');
    Route::get('/Exercice/{id}', [ExerciceController::class, 'ExerciceView'])->name('Exercice.View');
    Route::get('/Modules/{id}', [ModuleController::class, 'ModuleParticipant'])->name('Module.Participant');
    Route::post('/Deconnxion', [AuthController::class, 'deconnxion'])->name('deconnxion');
});

Route::get('/download/{file}', [CoursController::class, 'download'])->name('download');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/profil', function () {
        return view('profil');
    });

    // Route::get('/Participant', [participantController::class, 'viewFormParticipant'])->name('Enregistrement.Etudiant');

    // Route::get('/Formations', function () {
    //     return view('EnregistrementFormation');
    // })->name('Enregistrement.Formation');

    // Route::get('/Liste-Formations', [FormationController::class, 'ListeFormation'])->name('liste.Formation');
    // Route::get('/Liste-particiapants', [participantController::class, 'Listeparticiapants'])->name('liste.particiapants');
    // Route::post('/update-info', [ProfileController::class, 'updateInfo'])->name('update.info');
    // Route::post('/update-formation', [FormationController::class, 'updateformation'])->name('update.formation');
    // Route::post('/add-formation', [FormationController::class, 'addFormation'])->name('add.formation');
    // Route::post('/add-participant', [participantController::class, 'addParticipant'])->name('add.participant');
    // Route::post('/delete-participant', [participantController::class, 'deleteParticipant']);
    // Route::post('/Update-participant', [participantController::class, 'UpdateParticipant'])->name('update.participant');
    // Route::get('/delete-formation/{id}/{statut}', [FormationController::class, 'DeleteFormation'])->name('Delete.Formation');

    // Route::get('/Participant/{id}', [participantController::class, 'ParticipantDetail'])->name('Participant.Detail');
    // Route::get('/Delete-img/{id}', [participantController::class, 'DeleteImg'])->name('Delete.Img');
    // Route::post('/Nouvelle-Inscription', [participantController::class, 'NouvelleInscription'])->name('Nouvelle.Inscription');

    // Dashboard Data Render
    Route::get('/dashboard', [DataController::class, 'Index'])->name('dashboard');


    // //         Online Ressource
    // Route::get('/Cour', [CoursController::class, 'ViewCour'])->name('cour.index');
    // Route::post('/add-cour', [CoursController::class, 'addCour'])->name('add.cour');
    // Route::post('/add-pieces', [CoursController::class, 'addPieces'])->name('add.pieces');
    // Route::get('/Modules', [CoursController::class, 'ListeCours'])->name('Liste.cours');
    // Route::get('/Vue-Cour/{id}', [CoursController::class, 'CourDetails'])->name('view.cour');
    // Route::get('/Delete-cour/{id}', [CoursController::class, 'deleteCour'])->name('delete.cour');
    // Route::get('/Resources', [participantController::class, 'noteResources'])->name('note.Resources');

    // Route::get('/Exercices', [ExerciceController::class, 'Exercice'])->name('Exercice');
    // Route::post('/add-Exercice', [ExerciceController::class, 'addExercice'])->name('add.Exercice');
    // Route::post('/add-Question', [ExerciceController::class, 'addQuestion'])->name('add.Question');
    // Route::post('/add-Choix', [ExerciceController::class, 'addChoix'])->name('add.Choix');
    // Route::get('/Config-Exercices/{id}', [ExerciceController::class, 'ConfigExercices'])->name('Config.Exercices');
    // // modules 
    // Route::get('/Module/{id}', [CoursController::class, 'ModuleVue'])->name('Module.Vue');
    // Route::get('/Module', [ModuleController::class, 'index'])->name('Module.index');
    // Route::post('/Module', [ModuleController::class, 'store'])->name('Module.store');
    // Route::post('/Module-delete', [ModuleController::class, 'destroy'])->name('Module.destroy');
    // Route::post('/Module-update', [ModuleController::class, 'update'])->name('Module.update');
    // Route::get('/Evaluations-Exercices', [ExerciceController::class, 'EvaluationsExercices'])->name('Evaluations.Exercices');



    Route::get('/Courriels', function () {
        return view('CourrielListe');
    })->name('courriel.liste');


    //payements 
    // Route::get('/Payements', [PayementController::class, 'PayementIndex'])->name('Payement.index');
    // Route::post('/ajouter-Payement', [PayementController::class, 'addPayement'])->name('add.payement');
    // Route::get('/print-payement/{id}', [PayementController::class, 'printPayement'])->name('print.Payement');
    // Route::get('/Recus', function () {
    //     return view('print.payement-recus');
    // });

    // Route::post('/Payements-delete', [PayementController::class, 'PayementsDelete'])->name('Payement.Delete');

    // // note & matieres & categorie
    // Route::get('/Matieres', [MatiereController::class, 'index'])->name('matieres.index');
    // Route::post('/add-Matieres', [MatiereController::class, 'addMatieres'])->name('add.Matieres');
    // Route::post('/delete-Matieres', [MatiereController::class, 'deleteMatieres'])->name('delete.Matieres');
    // Route::post('/modify-Matieres', [MatiereController::class, 'modifyMatieres'])->name('modify.Matieres');
    // Route::get('/Notes', [CompositionController::class, 'index'])->name('index.composition');
    // Route::post('/add-Evaluation', [CompositionController::class, 'addEvaluation'])->name('add.Evaluation');
    // Route::get('/Evaluation', [CompositionController::class, 'indexEvaluation'])->name('index.Evaluation');
    // Route::post('/delete-Evaluation', [CompositionController::class, 'deleteEvaluation'])->name('delete.Evaluation');
    // Route::post('/udpate-Evaluation', [CompositionController::class, 'udpateEvaluation'])->name('udpate.Evaluation');
    // Route::post('/add-note', [CompositionController::class, 'addNote'])->name('add.Note');
    // Route::post('/Insertion', [CompositionController::class, 'Insertion'])->name('Insertion.add');
    // Route::post('/Insertion-note', [CompositionController::class, 'InsertionNote'])->name('Insertion.note'); // insertion rapide des notes
    // Route::post('/add-Categorie', [MatiereController::class, 'addCategorie'])->name('add.Categorie');
    // Route::post('/modify-Categorie', [MatiereController::class, 'modifyCategorie'])->name('modify.Categorie');
    // Route::post('/delete-Categorie', [MatiereController::class, 'deleteCategorie'])->name('delete.Categorie');
    // Route::get('/Bulletin', [BulletinController::class, 'index'])->name('Bulletin.index');
    // Route::post('/Bulletin', [BulletinController::class, 'GenerateBulletin'])->name('Generate.Bulletin');
    // Route::get('/Liste-Bulletin/{formation}/{anneeScolaire}/{evaluation}', [BulletinController::class, 'ListeBulletin'])->name('Liste.Bulletin');
    // Route::get('/Bulletins', [BulletinController::class, 'BulletinListe'])->name('Bulletin.Liste');
    // Route::post('/Liste-Bulletin', [BulletinController::class, 'TrieBulletin'])->name('Trie.Bulletin');
    // Route::get('/view/{route}', [BulletinController::class, 'view'])->name('view.Bulletin');
    // Route::get('/download-Bulletin/{route}', [BulletinController::class, 'download'])->name('download.Bulletin');
    // Route::get('/download-all/{formation}/{anneeScolaire}/{evaluation}', [BulletinController::class, 'downloadAll'])->name('download.all');
    // Route::get('/delete-all/{formation}/{anneeScolaire}/{evaluation}', [BulletinController::class, 'deleteAll'])->name('delete.all');
    // Route::post('/delete-composition', [CompositionController::class, 'deleteComposition'])->name('delete.composition');

    //enseigants
    Route::get('/Enseignants', [EnseignantController::class, 'index'])->name('index.Enseigant');
    Route::post('/save-enseignant', [EnseignantController::class, 'saveEnseignant'])->name('save.Enseignant');
    Route::post('/delete-enseignant', [EnseignantController::class, 'deleteEnseignant'])->name('delete.Enseignant');
    Route::post('/update-enseignant', [EnseignantController::class, 'updateEnseignant'])->name('update.Enseignant');

    // salle
    Route::get('/Salles', [SalleController::class, 'index'])->name('index.Salles');
    Route::post('/Salles', [SalleController::class, 'store'])->name('save.Salles');
    Route::post('/delete-Salle', [SalleController::class, 'deleteSalle'])->name('delete.Salle');
    Route::post('/update-Salle', [SalleController::class, 'update'])->name('update.Salle');

    // emploie de temps
    Route::get('/Empoloie', [EmploieController::class, 'index'])->name('index.Emploie');
    Route::post('/Empoloie', [EmploieController::class, 'store'])->name('store.Emploie');
    Route::post('/Empoloie-delete', [EmploieController::class, 'destroy'])->name('destroy.Emploie');
    Route::post('/Empoloie-update', [EmploieController::class, 'update'])->name('update.Emploie');
    Route::get('/Session/{id}', [EmploieController::class, 'sessionCour'])->name('session.Cour');
    Route::post('/Session', [EmploieController::class, 'sessionAdd'])->name('session.Add');
    Route::post('/Delete-session', [EmploieController::class, 'deleteSession'])->name('delete.Session');
    Route::get('/Heures', [EmploieController::class, 'heureDeCour'])->name('heure.DeCour');
    Route::post('/Heures', [EmploieController::class, 'storeHeure'])->name('store.Heure');
    Route::post('/Heures-delete', [EmploieController::class, 'deleteHeure'])->name('delete.Heure');
    // impression emploie de temps
    Route::get('/Impression-Emploie/{id}', [EmploieController::class, 'ImpressionEmploie'])->name('Impression.Emploie');

    // Rappors
    Route::get('/Payement-rapport', [RapportController::class, 'PayementRapportIndex'])->name('Payement.RapportIndex');
    Route::post('/Payement-rapport', [RapportController::class, 'PayementRapportCreate'])->name('Payement.RapportCreate');
    Route::post('/Transaction-rapport', [RapportController::class, 'TransactionRapportCreate'])->name('Transaction.RapportCreate');
    // Route::get('/Transaction-rapport', [RapportController::class, 'TransactionRapportIndex'])->name('Transaction.RapportIndex');
    Route::get('/Etudiant-rapport', [RapportController::class, 'EtudientRapportIndex'])->name('Etudient.RapportIndex');
    Route::post('/Etudiant-rapport', [RapportController::class, 'EtudientRapportCreate'])->name('Etudient.RapportCreate');
    Route::get('/Enseignant-rapport', [RapportController::class, 'EnseignantRapportCreate'])->name('Enseignant.RapportCreate');

    //general 
    // Route::get('/General', [GeneralController::class, 'index'])->name('General.index');
    // Route::post('/Years', [GeneralController::class, 'Years'])->name('General.Years');
    // Route::post('/Active-years', [GeneralController::class, 'ActiveYears'])->name('Active.Years');
    // Route::get('/Identite', [GeneralController::class, 'indexIdentite'])->name('index.Identite');
    // Route::post('/Personnel', [GeneralController::class, 'storeUser'])->name('store.Personnel');
    // Route::post('/Identite', [GeneralController::class, 'update'])->name('update.Identite');
    // Route::get('/Personnel-delete/{id}', [GeneralController::class, 'deletePersonnel'])->name('Personnel.delete');
    // Route::post('/Personnel-update', [GeneralController::class, 'updatePersonnel'])->name('Personnel.update');

    Route::get('/403', function () {
        return view('pageError.403');
    })->name('403');
});

Route::middleware(['auth', 'role:Scolarite'])->group(function () {

    // participant formation
    Route::get('/Participant', [participantController::class, 'viewFormParticipant'])->name('Enregistrement.Etudiant');

    Route::get('/Formations', function () {
        return view('EnregistrementFormation');
    })->name('Enregistrement.Formation');

    Route::get('/Liste-Formations', [FormationController::class, 'ListeFormation'])->name('liste.Formation');
    Route::get('/Liste-particiapants', [participantController::class, 'Listeparticiapants'])->name('liste.particiapants');
    Route::get('/Admission', [participantController::class, 'DemandeAdmission'])->name('Demande.Admission');
    Route::post('/update-info', [ProfileController::class, 'updateInfo'])->name('update.info');
    Route::post('/update-formation', [FormationController::class, 'updateformation'])->name('update.formation');
    Route::post('/add-formation', [FormationController::class, 'addFormation'])->name('add.formation');
    Route::post('/add-participant', [participantController::class, 'addParticipant'])->name('add.participant');
    Route::post('/delete-participant', [participantController::class, 'deleteParticipant']);
    Route::post('/Update-participant', [participantController::class, 'UpdateParticipant'])->name('update.participant');
    Route::get('/delete-formation/{id}/{statut}', [FormationController::class, 'DeleteFormation'])->name('Delete.Formation');

    Route::get('/Participant/{id}', [participantController::class, 'ParticipantDetail'])->name('Participant.Detail');
    Route::get('/Delete-img/{id}', [participantController::class, 'DeleteImg'])->name('Delete.Img');
    Route::post('/Nouvelle-Inscription', [participantController::class, 'NouvelleInscription'])->name('Nouvelle.Inscription');

    Route::post('/Payements-delete', [PayementController::class, 'PayementsDelete'])->name('Payement.Delete'); /////

    // note & matieres & categorie
    Route::get('/Matieres', [MatiereController::class, 'index'])->name('matieres.index');
    Route::post('/add-Matieres', [MatiereController::class, 'addMatieres'])->name('add.Matieres');
    Route::post('/delete-Matieres', [MatiereController::class, 'deleteMatieres'])->name('delete.Matieres');
    Route::post('/modify-Matieres', [MatiereController::class, 'modifyMatieres'])->name('modify.Matieres');
    Route::get('/Notes', [CompositionController::class, 'index'])->name('index.composition');
    Route::post('/add-Evaluation', [CompositionController::class, 'addEvaluation'])->name('add.Evaluation');
    Route::get('/Evaluation', [CompositionController::class, 'indexEvaluation'])->name('index.Evaluation');
    Route::post('/delete-Evaluation', [CompositionController::class, 'deleteEvaluation'])->name('delete.Evaluation');
    Route::post('/udpate-Evaluation', [CompositionController::class, 'udpateEvaluation'])->name('udpate.Evaluation');
    Route::post('/add-note', [CompositionController::class, 'addNote'])->name('add.Note');
    Route::post('/Insertion', [CompositionController::class, 'Insertion'])->name('Insertion.add');
    Route::post('/Insertion-note', [CompositionController::class, 'InsertionNote'])->name('Insertion.note'); // insertion rapide des notes
    Route::post('/add-Categorie', [MatiereController::class, 'addCategorie'])->name('add.Categorie');
    Route::post('/modify-Categorie', [MatiereController::class, 'modifyCategorie'])->name('modify.Categorie');
    Route::post('/delete-Categorie', [MatiereController::class, 'deleteCategorie'])->name('delete.Categorie');
    Route::get('/Bulletin', [BulletinController::class, 'index'])->name('Bulletin.index');
    Route::post('/Bulletin', [BulletinController::class, 'GenerateBulletin'])->name('Generate.Bulletin');
    Route::get('/Liste-Bulletin/{formation}/{anneeScolaire}/{evaluation}', [BulletinController::class, 'ListeBulletin'])->name('Liste.Bulletin');
    Route::get('/Bulletins', [BulletinController::class, 'BulletinListe'])->name('Bulletin.Liste');
    Route::post('/Liste-Bulletin', [BulletinController::class, 'TrieBulletin'])->name('Trie.Bulletin');
    Route::get('/view/{route}', [BulletinController::class, 'view'])->name('view.Bulletin');
    Route::get('/download-Bulletin/{route}', [BulletinController::class, 'download'])->name('download.Bulletin');
    Route::get('/download-all/{formation}/{anneeScolaire}/{evaluation}', [BulletinController::class, 'downloadAll'])->name('download.all');
    Route::get('/delete-all/{formation}/{anneeScolaire}/{evaluation}', [BulletinController::class, 'deleteAll'])->name('delete.all');
    Route::post('/delete-composition', [CompositionController::class, 'deleteComposition'])->name('delete.composition');
});

Route::middleware(['auth', 'role:Secretariat'])->group(function () {
    Route::get('/Payements', [PayementController::class, 'PayementIndex'])->name('Payement.index');
    Route::post('/ajouter-Payement', [PayementController::class, 'addPayement'])->name('add.payement');
    Route::get('/print-payement/{id}', [PayementController::class, 'printPayement'])->name('print.Payement');
    Route::get('/Recus', function () {
        return view('print.payement-recus');
    });

    // Route::post('/Payements-delete', [PayementController::class, 'PayementsDelete'])->name('Payement.Delete');
});

Route::middleware(['auth', 'role:Admin'])->group(function () {
    //general 
    Route::get('/General', [GeneralController::class, 'index'])->name('General.index');
    Route::post('/Years', [GeneralController::class, 'Years'])->name('General.Years');
    Route::post('/Active-years', [GeneralController::class, 'ActiveYears'])->name('Active.Years');
    Route::get('/Identite', [GeneralController::class, 'indexIdentite'])->name('index.Identite');
    Route::post('/Personnel', [GeneralController::class, 'storeUser'])->name('store.Personnel');
    Route::post('/Identite', [GeneralController::class, 'update'])->name('update.Identite');
    Route::get('/Personnel-delete/{id}', [GeneralController::class, 'deletePersonnel'])->name('Personnel.delete');
    Route::post('/Personnel-update', [GeneralController::class, 'updatePersonnel'])->name('Personnel.update');
});

Route::middleware(['auth', 'categorie:4'])->group(function () {
    //         Online Ressource
    Route::get('/Cour', [CoursController::class, 'ViewCour'])->name('cour.index');
    Route::post('/add-cour', [CoursController::class, 'addCour'])->name('add.cour');
    Route::post('/add-pieces', [CoursController::class, 'addPieces'])->name('add.pieces');
    Route::get('/Modules', [CoursController::class, 'ListeCours'])->name('Liste.cours');
    Route::get('/Vue-Cour/{id}', [CoursController::class, 'CourDetails'])->name('view.cour');
    Route::get('/Delete-cour/{id}', [CoursController::class, 'deleteCour'])->name('delete.cour');
    Route::get('/Update-cour/{id}', [CoursController::class, 'UpdateCour'])->name('Update.cour');
    Route::post('/Update-Cour', [CoursController::class, 'ModifyCour'])->name('ModifyCour.cour');
    Route::get('/delete-image/{id}', [CoursController::class, 'deleteImage'])->name('delete.Image');
    Route::get('/delete-video/{id}', [CoursController::class, 'deleteVideo'])->name('delete.video');
    Route::get('/Resources', [participantController::class, 'noteResources'])->name('note.Resources');

    Route::get('/Exercices', [ExerciceController::class, 'Exercice'])->name('Exercice');
    Route::post('/add-Exercice', [ExerciceController::class, 'addExercice'])->name('add.Exercice');
    Route::post('/add-Question', [ExerciceController::class, 'addQuestion'])->name('add.Question');
    Route::post('/add-Choix', [ExerciceController::class, 'addChoix'])->name('add.Choix');
    Route::get('/Config-Exercices/{id}', [ExerciceController::class, 'ConfigExercices'])->name('Config.Exercices');
    // modules 
    Route::get('/Module/{id}', [CoursController::class, 'ModuleVue'])->name('Module.Vue');
    Route::get('/Module', [ModuleController::class, 'index'])->name('Module.index');
    Route::post('/Module', [ModuleController::class, 'store'])->name('Module.store');
    Route::post('/Module-delete', [ModuleController::class, 'destroy'])->name('Module.destroy');
    Route::post('/Module-update', [ModuleController::class, 'update'])->name('Module.update');
    Route::get('/Evaluations-Exercices', [ExerciceController::class, 'EvaluationsExercices'])->name('Evaluations.Exercices');
});

Route::middleware(['auth', 'plant:premium'])->group(function () {});


require __DIR__ . '/auth.php';
