<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Formation;
use App\Models\Evaluation;
use App\Models\Categorie;
use App\Models\FormationParticipant;
use App\Models\Participant;
use App\Models\Composition;
use App\Models\Matiere;
use App\Models\Bulletin;
use App\Models\Identify;
use App\Models\Emploie;
use App\Models\Session;
use App\Models\Years;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use ZipArchive;
use Dompdf\Options;


class BulletinController extends Controller
{
    public function index()
    {
        $Formations = Formation::where('randomUser', Auth::user()->random)
            ->where('statue', '=', '1')->get();
        $Evaluations = Evaluation::where('randomUser', Auth::user()->random)->get();
        $years = Years::where('randomUser', Auth::user()->random)->get();
        return view('EnregistrementBulletin', compact('Formations', 'Evaluations', 'years'));
    }
    public function GenerateBulletin(Request $request)
    {
        $request->validate([
            'formation' => 'required',
            'anneescolaire' => 'required',
            'evaluation' => 'required'
        ]);

        $userRandom = Auth::user()->random;
        $identify =  Identify::where('randomUser', '=', $userRandom)->get();
        $Evaluation =  Evaluation::find($request->evaluation);
        // $Categories =  Categorie::where('randomUser', '=', $userRandom)->get();


        // Récupérer toutes les FormationParticipant pour l'année scolaire et le niveau spécifiés
        $FormationParticipants = FormationParticipant::where('formation_id', $request->formation)
            ->where('anneeScolaire', $request->anneescolaire)
            ->get();


        if (count($FormationParticipants) == 0) {
            return redirect()->route('Bulletin.index')->with('success', 'Aucun Bulletin a generer.');
        }

        $effectif = count($FormationParticipants);

        // Récupérer les moyennes des autres participants dans la même classe
        $participantsMoyennes = [];

        foreach ($FormationParticipants as $FormationParticipant) {
            $moyenne = Composition::where('formation_participant_id', $FormationParticipant->id)
                ->join('matieres', 'compositions.matiere_id', '=', 'matieres.id')
                ->selectRaw('SUM(compositions.note * matieres.coefs) / SUM(matieres.coefs) as moyenne')
                ->where('compositions.evaluation_id', $request->evaluation)
                ->groupBy('compositions.formation_participant_id')
                ->pluck('moyenne')
                ->first();

            // Sauvegarder la moyenne avec l'ID du participant
            $participantsMoyennes[$FormationParticipant->participant_id] = $moyenne;
        }


        arsort($participantsMoyennes); // Trie le tableau en ordre décroissant

        $sumMoy = array_sum($participantsMoyennes);

        $nbrValleurSup = array_filter($participantsMoyennes, function ($valeur) {
            return $valeur > 10;
        });

        // foreach($participantsMoyennes as $participantsMoyenne){

        // }
        // calcul de l'ecart type
        $moyenneClasse = $sumMoy / count($participantsMoyennes);
        $variance = 0;
        foreach ($participantsMoyennes as $participantsMoyenne) {
            $variance += pow($participantsMoyenne -  $moyenneClasse, 2);
        }
        $variance /= (count($participantsMoyennes) - 1);
        $ecartType =  sqrt($variance);



        foreach ($FormationParticipants as $FormationParticipant) {

            // Initialiser les données du bulletin
            $bulletinData = [];
            $Categories = [];
            $vals = [];
            $totalPoints = 0;
            $totalCoefficients = 0;

            // Récupérer toutes les compositions pour cette classe participant

            $compositions = Composition::where('formation_participant_id', $FormationParticipant->id)
                ->where('evaluation_id', $request->evaluation)
                ->with('matiere') // On récupère aussi la matière associée
                ->get();
                

            // Traitement de chaque composition

            foreach ($compositions as $composition) {

                $matiere = $composition->matiere;

                if ($matiere) {

                    $noteNonCoefficient = $composition->note;
                    $noteCoefficient = $noteNonCoefficient * $matiere->coefs; // Note obtenue coefficiée
                    $totalPoints += $noteCoefficient;
                    $totalCoefficients += $matiere->coefs;

                    // / Calculez la moyenne pour cette matière dans cette classe, année scolaire et numéro d’évaluation

                    $moyenneGeneraleMatiere = Composition::where('matiere_id', $matiere->id)
                        ->where('evaluation_id', $request->evaluation)
                        ->join('formation_participants', 'formation_participants.id', '=', 'compositions.formation_participant_id')
                        ->where('formation_participants.formation_id', $request->formation)
                        ->where('formation_participants.anneeScolaire', $request->anneescolaire)
                        ->avg('note');

                    // Récupérer les notes pour établir le max, min et le pourcentage de réussite

                    $max = Composition::where('matiere_id', $matiere->id)
                        ->where('evaluation_id', $request->evaluation)
                        ->join('formation_participants', 'formation_participants.id', '=', 'compositions.formation_participant_id')
                        ->where('formation_participants.formation_id', $request->formation)
                        ->where('formation_participants.anneeScolaire', $request->anneescolaire)
                        ->max('note');

                    $min = Composition::where('matiere_id', $matiere->id)
                        ->where('evaluation_id', $request->evaluation)
                        ->join('formation_participants', 'formation_participants.id', '=', 'compositions.formation_participant_id')
                        ->where('formation_participants.formation_id', $request->formation)
                        ->where('formation_participants.anneeScolaire', $request->anneescolaire)
                        ->min('note');


                    $totalNotes = Composition::where('formation_participant_id', $FormationParticipant->id)
                        ->where('matiere_id', $matiere->id)
                        ->where('evaluation_id', $request->evaluation)
                        ->count();

                    $noteReussite = $noteNonCoefficient >= 10 ? 1 : 0; // 1 si réussi, sinon 0
                    $pourcentageReussite = ($noteReussite / $totalNotes) * 100;

                    // Récupération de l'appréciation

                    $appreciation = $composition->appreciate;

                    // Trouver le rang du participant

                    // if (!in_array($matiere->categorie_id, $Categories)) {
                    //     $Categories[] = $matiere->categorie_id;
                    // }
                    if (!empty($matiere->categorie_id)) {
                        if (!in_array($matiere->categorie_id, $vals)) {

                            $sumCat = Categorie::where('categories.id', $matiere->categorie_id)
                                ->join('matieres', 'matieres.categorie_id', '=', 'categories.id')
                                ->join('compositions', 'compositions.matiere_id', '=', 'matieres.id')
                                ->join('formation_participants', 'compositions.formation_participant_id', '=', 'formation_participants.id')
                                ->selectRaw('SUM(compositions.note * matieres.coefs) as sum')
                                ->where('compositions.evaluation_id', $request->evaluation)
                                ->where('formation_participants.id', $FormationParticipant->id)
                                ->groupBy('compositions.formation_participant_id')
                                ->pluck('sum')
                                ->first();

                            $moyCat = Categorie::where('categories.id', $matiere->categorie_id)
                                ->join('matieres', 'matieres.categorie_id', '=', 'categories.id')
                                ->join('compositions', 'compositions.matiere_id', '=', 'matieres.id')
                                ->join('formation_participants', 'compositions.formation_participant_id', '=', 'formation_participants.id')
                                ->selectRaw('SUM(compositions.note * matieres.coefs) / SUM(matieres.coefs) as moyenne')
                                ->where('compositions.evaluation_id', $request->evaluation)
                                ->where('formation_participants.id', $FormationParticipant->id)
                                ->groupBy('compositions.formation_participant_id')
                                ->pluck('moyenne')
                                ->first();

                            $vals[] = $matiere->categorie_id;

                            $Categories[] = [
                                'id' => $matiere->categorie_id,
                                'libelle' => $matiere->Categorie->libeller,
                                'sum' => $sumCat,
                                'moy' => number_format($moyCat, 2),
                            ];
                        }
                    } else {
                        if (!in_array($matiere->categorie_id, $vals)) {

                            $sumCat = Matiere::whereNull('matieres.categorie_id')
                                ->join('compositions', 'compositions.matiere_id', '=', 'matieres.id')
                                ->join('formation_participants', 'compositions.formation_participant_id', '=', 'formation_participants.id')
                                ->selectRaw('SUM(compositions.note * matieres.coefs) as sum')
                                ->where('compositions.evaluation_id', $request->evaluation)
                                ->where('formation_participants.id', $FormationParticipant->id)
                                ->groupBy('compositions.formation_participant_id')
                                ->pluck('sum')
                                ->first();

                            $moyCat = Matiere::whereNull('matieres.categorie_id')
                                ->join('compositions', 'compositions.matiere_id', '=', 'matieres.id')
                                ->join('formation_participants', 'compositions.formation_participant_id', '=', 'formation_participants.id')
                                ->selectRaw('SUM(compositions.note * matieres.coefs) / SUM(matieres.coefs) as moyenne')
                                ->where('compositions.evaluation_id', $request->evaluation)
                                ->where('formation_participants.id', $FormationParticipant->id)
                                ->groupBy('compositions.formation_participant_id')
                                ->pluck('moyenne')
                                ->first();

                            $vals[] = $matiere->categorie_id;

                            $Categories[] = [
                                'id' => $matiere->categorie_id,
                                'libelle' => 'Autre Matières',
                                'sum' => $sumCat,
                                'moy' => number_format($moyCat, 2),
                            ];
                        }
                    }

                    // ->whereRaw("STR_TO_DATE(emploies.date_fin, '%m/%d/%Y') >= CURDATE()")
                    $Enseignant = Session::where('matiere_id', '=',  $matiere->id)
                        ->join('emploies', 'sessions.emploie_id', '=', 'emploies.id')
                        ->where('emploies.niveau', null)
                        ->where('emploies.anneeScolaire', $request->anneescolaire)
                        ->where('emploies.formation_id', "=", $request->formation)
                        ->join('enseigants', 'enseigants.id', '=', 'sessions.enseigant_id')
                        ->first();

                    if (empty($Enseignant->enseigant_id)) {
                        $name = " ";
                    } else {
                        $name = $Enseignant->nom . " " . $Enseignant->prenom;
                    }
                    // Formatage des données de la matière

                    $bulletinData[] = [
                        'libelle' => $matiere->libeller,
                        'enseigant' =>  $name,
                        'coef' => $matiere->coefs,
                        'note_obtenue_non_coefficient' => $noteNonCoefficient,
                        'note_obtenue_coefficient' => $noteCoefficient,
                        'moyenne_generale' => $moyenneGeneraleMatiere,
                        'categorie' => $matiere->categorie_id ?? null,
                        'pourcentage_reussite' => $pourcentageReussite,
                        'min' => $min,
                        'max' => $max,
                        'appreciation' => $appreciation,
                    ];
                }
            }

            $rank = 1;
            $previousMoyenne = null;
            $equalRank = 1;

            foreach ($participantsMoyennes as $participantId => $moyenne) {
                if ($moyenne !== $previousMoyenne) {
                    $equalRank = $rank;
                }

                if ($participantId == $FormationParticipant->participant_id) {
                    $rang = $equalRank;
                    break;
                }

                $previousMoyenne = $moyenne;
                $rank++;
            }

            $participants = FormationParticipant::where('id', '=', $FormationParticipant->id)->get();

            // Calculons la moyenne générale du participant
            $moyenneGeneraleParticipant = $totalCoefficients > 0 ? $totalPoints / $totalCoefficients : 0;

            if ($moyenneGeneraleParticipant <= 10) {
                $app = "Faible";
            } elseif ($moyenneGeneraleParticipant < 10 && $moyenneGeneraleParticipant <= 12) {
                $app = "Passable";
            } elseif ($moyenneGeneraleParticipant < 12 && $moyenneGeneraleParticipant <= 16) {
                $app = "Bien";
            } elseif ($moyenneGeneraleParticipant < 16) {
                $app = "Tres bien";
            }

            if ($moyenneGeneraleParticipant >= 12) {
                $Tn = "Oui";
            } else {
                $Tn = "Non";
            }

            if (!empty($request->eval_prev)) {
                // on recuppere une autre evalution pour l'ajouter dans le bulletin 
                $bulletin = Bulletin::where('evaluation_id', $request->eval_prev)
                    ->where('participant_id', $FormationParticipant->Participant->id)
                    ->where('formation_id', $FormationParticipant->Formation->id)
                    ->where('anneeScolaire', $request->anneescolaire)
                    ->orderBy('id', 'desc')
                    ->first();

                if (!empty($bulletin)) {
                    $max_moy = Bulletin::where('evaluation_id', $request->eval_prev)
                        ->where('formation_id', $FormationParticipant->Formation->id)
                        ->where('anneeScolaire', $request->anneescolaire)
                        ->selectRaw('total_point / total_coef as moyenne')
                        ->orderBy('moyenne', 'desc')
                        ->first();

                    $min_moy = Bulletin::where('evaluation_id', $request->eval_prev)
                        ->where('formation_id', $FormationParticipant->Formation->id)
                        ->where('anneeScolaire', $request->anneescolaire)
                        ->selectRaw('total_point / total_coef as moyenne')
                        ->orderBy('moyenne', 'asc')
                        ->first();

                    $evaluation = Evaluation::where('id', $request->eval_prev)->value('libeller');

                    $moy = $bulletin->total_point / $bulletin->total_coef;


                    if ($moy <= 10) {
                        $app = "Faible";
                    } elseif ($moy > 10 && $moy <= 12) {
                        $app = "Passable";
                    } elseif ($moy > 12 && $moy <= 16) {
                        $app = "Bien";
                    } elseif ($moy > 16) {
                        $app = "Tres bien";
                    }

                    if ($moy >= 12) {
                        $Tn = "Oui";
                    } else {
                        $Tn = "Non";
                    }

                    $prevData[] = [
                        'rank' =>  $bulletin->rank,
                        'evaluation' =>  $evaluation,
                        'totalPoints' =>  $bulletin->total_point,
                        'totalCoefficients' =>  $bulletin->total_coef,
                        'moy' =>  number_format($moy, 2),
                        'tn' =>  $Tn,
                        'appreciation' => $app,
                        'min_moy' => number_format($min_moy->moyenne, 2),
                        'max_moy' => number_format($max_moy->moyenne, 2),
                        'moy_general' => number_format($max_moy->moyenne, 2),
                    ];
                } else {
                    $prevData = [];
                }
            } else {
                $prevData = [];
            }

            $data[] = [
                'Evaluation' => $Evaluation->libeller,
                'moy' => number_format($moyenneGeneraleParticipant, 2),
                'rank' => $rang,
                'totalCoefficients' => $totalCoefficients,
                'totalPoints' => $totalPoints,
                'appreciation' => $app,
                'Tn' => $Tn,
                'effectif' => $effectif,
                'max_moy' => number_format(max($participantsMoyennes), 2),
                'min_moy' => number_format(min($participantsMoyennes), 2),
                'nbr_supA1O' => count($nbrValleurSup),
                'moy_general' =>  number_format(($sumMoy / $effectif), 2),
                'ecart_type' =>  number_format($ecartType, 4),
                'taux_reussite' =>  number_format(((count($nbrValleurSup) / $effectif) * 100), 0),
            ];


            // Créer le dossier "Bulletins" dans le système de stockage

            Storage::disk('public')->makeDirectory('Bulletins');

            $number =  time();
            $filename = 'Bulletins/' . $FormationParticipant->Participant->nom . '_' . $FormationParticipant->Participant->prenom . '_' . $FormationParticipant->anneeScolaire . '_' . $FormationParticipant->Formation->nom . '_' . $request->evaluation . '_' . $number . '.pdf';

            Pdf::loadView('print.bulletin', compact('bulletinData', 'moyenneGeneraleParticipant', 'identify', 'participants', 'effectif', 'Categories', 'data', 'prevData'))
                ->save(storage_path('app/public/' . $filename));

            // enregistrer le  bulletin 
            $Bulletin =  new Bulletin();
            $Bulletin->route = $filename;
            $Bulletin->total_point = $totalPoints;
            $Bulletin->total_coef = $totalCoefficients;
            $Bulletin->rank = $rang;
            $Bulletin->randomUser = $userRandom;
            $Bulletin->anneeScolaire = $FormationParticipant->anneeScolaire;
            $Bulletin->evaluation_id = $request->evaluation;
            $Bulletin->formation_id = $request->formation;
            $Bulletin->participant_id = $FormationParticipant->Participant->id;
            $Bulletin->save();

            $bulletinData = [];
            $Categories = [];
            $vals = [];
            $data = [];
            $prevData = [];
        }
        return redirect()->route('Liste.Bulletin', [
            'formation' => $request->formation,
            'anneeScolaire' => $request->anneescolaire,
            'evaluation' => $request->evaluation,
        ]);
    }

    public function ListeBulletin($formation, $anneeScolaire, $evaluation)
    {
        $Bulletins = Bulletin::where('evaluation_id', $evaluation)
            ->where('formation_id', $formation)
            ->where('anneeScolaire', $anneeScolaire)->get();

        $data[] = [
            'evaluation' => $evaluation,
            'formation' => $formation,
            'anneeScolaire' => $anneeScolaire
        ];

        // $Evaluation =  Evaluation::Find($evaluation);
        // dd($Evaluation->libeller);
        // dd($Bulletins);
        return view('ListeBulletin', compact('Bulletins', 'data'));
    }
    public function view($route)
    {
        $filename = Bulletin::where('id', $route)->value('route');
        $fileroute = storage_path('app/public/' . $filename);
        return response()->file($fileroute);
    }

    public function download($route)
    {
        $filename = Bulletin::where('id', $route)->value('route');

        if (Storage::disk('public')->exists($filename)) {
            return Storage::disk('public')->download($filename);
        }
        abort(404);

        // return Storage::disk('public')->download($fileroute);
        // return response()->file($fileroute);
    }
    public function downloadAll($formation, $anneeScolaire, $evaluation)
    {
        $Bulletins = Bulletin::where('evaluation_id', $evaluation)
            ->where('formation_id', $formation)
            ->where('anneeScolaire', $anneeScolaire)->get();

        if (empty($Bulletins)) {
            abort(400);
        }

        $zip = new ZipArchive();
        $zipFileName = 'Bulletins.zip';
        $zipPath = storage_path('app/' . $zipFileName);
        $BulletinName = "";

        if ($zip->open($zipPath, ZipArchive::CREATE) === TRUE) {

            foreach ($Bulletins as $bulletin) {
                if (empty($BulletinName)) {
                    $BulletinName = $bulletin->Formation->nom . '_' . $bulletin->anneeScolaire . '_' . $bulletin->Evaluation->libeller . '.zip';
                }
                $filename = $bulletin->route;
                $Path = Storage::disk('public')->path($filename);
                // $Path = storage_path('app/' . $filename);
                // dd($Path);
                if (Storage::disk('public')->exists($filename)) {
                    // return Storage::disk('public')->download($filename);
                    $name = $bulletin->Participant->nom . '_' . $bulletin->Participant->prenom . '_' . $bulletin->anneeScolaire . '_' . $bulletin->Formation->nom . '_' . $bulletin->Evaluation->libeller . '.pdf';
                    $zip->addFile($Path, $name);
                } else {
                    $zip->close();
                    unlink($zipPath);
                    abort(400);
                }
            }
            $zip->close();
            return response()->download($zipPath, $BulletinName)->deleteFileAfterSend(true);
        } else {
            abort(404);
        }
    }
    public function deleteAll($formation, $anneeScolaire, $evaluation)
    {
        $Bulletins = Bulletin::where('evaluation_id', $evaluation)
            ->where('formation_id', $formation)
            ->where('anneeScolaire', $anneeScolaire)->get();

        if (empty($Bulletins)) {
            abort(400);
        }

        $filePaths = [];

        foreach ($Bulletins as $bulletin) {
            $filePath =  storage_path('app/public/' . $bulletin->route);
            if (!str_starts_with($filePath, storage_path('app/public/'))) {
                abort(403, 'Acces non autorisé');
            }
            $filePaths[] = $filePath;
            $bulletin->delete();
        }
        Storage::delete($filePaths);
        return redirect()->route('Bulletin.index')->with('success', 'Bulletin supprimer.');
    }
    public function BulletinListe()
    {
        $userRandom = Auth::user()->random;

        $Formations = Formation::where('randomUser', $userRandom)
            ->where('statue', '=', '1')->get();

        $Evaluations = Evaluation::where('randomUser', $userRandom)->get();

        $Bulletins = Bulletin::where('randomUser', $userRandom)->get();

        return view('BulletinGenerer', compact('Bulletins', 'Evaluations', 'Formations'));
    }
    public function TrieBulletin(Request $request)
    {
        $request->validate([
            'formation' => 'required',
            'anneescolaire' => 'required',
            'evaluation' => 'required'
        ]);

        return redirect()->route('Liste.Bulletin', [
            'formation' => $request->formation,
            'anneeScolaire' => $request->anneescolaire,
            'evaluation' => $request->evaluation,
        ]);
    }
}
