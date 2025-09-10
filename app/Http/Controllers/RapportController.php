<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\Payement;
use App\Models\Tranche;
use App\Models\Enseigant;
use App\Models\FormationParticipant;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use FontLib\Table\Type\name;
use Illuminate\Support\Facades\Storage;
use App\Models\Identify;
use App\Models\Years;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RapportController extends Controller
{
    public function PayementRapportIndex()
    {
        $Formations = Formation::where('randomUser', Auth::user()->random)
            ->where('statue', '=', '1')->get();
        $years = Years::where('randomUser', Auth::user()->random)->get();
        return view('rapports.Payement-Rapport-Index', compact('Formations', 'years'));
    }
    public function TransactionRapportIndex()
    {
        $Formations = Formation::where('randomUser', Auth::user()->random)
            ->where('statue', '=', '1')->get();
        return view('rapports.Transaction-Rapport-Index', compact('Formations'));
    }
    public function EtudientRapportIndex()
    {
        $Formations = Formation::where('randomUser', Auth::user()->random)
            ->where('statue', '=', '1')->get();
        $years = Years::where('randomUser', Auth::user()->random)->get();

        return view('rapports.Etudient-Rapport-Index', compact('Formations', 'years'));
    }
    public function PayementRapportCreate(Request $request)
    {
        $request->validate(([
            'anneescolaire' => 'required',
            'niv' => 'nullable',
            'formation' => 'nullable|exists:formations,id',
        ]));

        $query = FormationParticipant::query();

        $optionFormation = $request->input('formation');
        $optionNiveau = $request->input('niv');
        $optionAnneescolaire = $request->input('anneescolaire');

        $query->where('anneeScolaire', $optionAnneescolaire);

        $query->when($optionFormation, function ($query, $optionFormation) {
            if (!empty($optionFormation)) {
                return $query->where('formation_id', $optionFormation);
            } else {
                return $query->join('formations', 'formations.id', '=', 'formation_participants.formation_id')->where('formations.randomUser', Auth::user()->random);
            }
        });

        $query->when($optionNiveau, function ($query, $optionNiveau) {
            if (!empty($optionNiveau)) {
                return $query->where('niv', $optionNiveau);
            }
        });

        $Formations = Formation::where('randomUser', Auth::user()->random)
            ->where('statue', '=', '1')
            ->orderBy('nom', 'asc')
            ->get();

        $PayementListe = $query->get();

        $name = uniqid();

        $TotalTranches = [];

        foreach ($Formations as $Formation) {
            for ($i = 0; $i < 5; $i++) {
                if ($i == 0) {
                    $TotalInscription = Tranche::where('formation_id', $Formation->id)->where('numero', '<=', $i)->sum('montant');
                } elseif ($i == 1) {
                    $TotalPremiere = Tranche::where('formation_id', $Formation->id)->where('numero', '<=', $i)->sum('montant');
                } elseif ($i == 2) {
                    $TotalDeuxieme = Tranche::where('formation_id', $Formation->id)->where('numero', '<=', $i)->sum('montant');
                } elseif ($i == 3) {
                    $TotalTroisime = Tranche::where('formation_id', $Formation->id)->where('numero', '<=', $i)->sum('montant');
                }
            }

            $TotalTranches[$Formation->id] = [
                'TotalInscription' => $TotalInscription,
                'TotalPremiere' => $TotalPremiere,
                'TotalDeuxieme' => $TotalDeuxieme,
                'TotalTroisime' => $TotalTroisime,
            ];
        }

        // Créer le dossier "PayementRecus" dans le système de stockage
        Storage::disk('public')->makeDirectory('Rapports/PayementRapport');

        $filename = 'Rapports/PayementRapport/' . $name . '.pdf';
        $identify =  Identify::where('randomUser', '=', Auth::user()->random)->value('logo');

        // Générer le PDF en utilisant le chemin absolu pour l'image
        Pdf::loadView('print.PayementRapport', compact('PayementListe', 'identify', 'Formations', 'optionAnneescolaire', 'TotalTranches'))
            ->save($fileroute = storage_path('app/public/' . $filename));

        // Retourner le fichier PDF
        return response()->file($fileroute);
    }
    public function TransactionRapportCreate(Request $request)
    {
        $request->validate([
            'end_date' => 'required|date',
            'niveau' => 'nullable',
            'start_date' => 'required|date',
            'form' => 'nullable',
        ]);

        $optionFormation = $request->input('form');
        $optionNiveau = $request->input('niveau');

        // Récupérer les dates de début et de fin au format 'Month Year' (par exemple "December 2025")
        $start_date = $request->input('start_date');  // Format attendu: 'December 2025'
        $end_date = $request->input('end_date');      // Format attendu: 'July 2026'


        // Convertir les dates au format 'Y-m-01' pour début (premier jour du mois)
        $start_date = Carbon::createFromFormat('F Y', $start_date)->startOfMonth()->toDateString();

        // Convertir les dates au format 'Y-m-t' pour fin (dernier jour du mois)
        $end_date = Carbon::createFromFormat('F Y', $end_date)->endOfMonth()->toDateString();

        $query = Payement::query();

        $query->whereBetween('pay_date', [$start_date, $end_date]);

        $query->when($optionFormation, function ($query, $optionFormation) {
            if (!empty($optionFormation)) {
                return $query->join('formation_participants', 'formation_participants.id', '=', 'payements.formation_participant_id')->where('formation_participants.formation_id', $optionFormation);
            } else {
                return $query->join('formation_participants', 'formation_participants.id', '=', 'payements.formation_participant_id')
                    ->join('formations', 'formations.id', '=', 'formation_participants.formation_id')
                    ->where('formations.randomUser', Auth::user()->random);
            }
        });

        $query->when($optionNiveau, function ($query, $optionNiveau) {
            if (!empty($optionNiveau)) {
                return $query->where('niv', $optionNiveau);
            }
        });

        $Payements = $query->get();

        $name = uniqid();

        // Créer le dossier "PayementRecus" dans le système de stockage
        Storage::disk('public')->makeDirectory('Rapports/TransactionRapport');

        $filename = 'Rapports/TransactionRapport/' . $name . '.pdf';
        $identify =  Identify::where('randomUser', '=', Auth::user()->random)->value('logo');

        // Générer le PDF en utilisant le chemin absolu pour l'image
        Pdf::loadView('print.PayementTransactionRapport', compact('Payements', 'identify', 'start_date', 'end_date'))
            ->save($fileroute = storage_path('app/public/' . $filename));

        // Retourner le fichier PDF
        return response()->file($fileroute);

        dd($Payements);
    }
    public function EtudientRapportCreate(Request $request)
    {
        $request->validate(([
            'anneescolaire' => 'required',
            'niv' => 'nullable',
            'formation' => 'nullable|exists:formations,id',
        ]));

        $query = FormationParticipant::query();

        $optionFormation = $request->input('formation');
        $optionNiveau = $request->input('niv');
        $optionAnneescolaire = $request->input('anneescolaire');

        $query->where('anneeScolaire', $optionAnneescolaire);

        $query->when($optionFormation, function ($query, $optionFormation) {
            if (!empty($optionFormation)) {
                return $query->where('formation_id', $optionFormation);
            } else {
                return $query->join('formations', 'formations.id', '=', 'formation_participants.formation_id')->where('formations.randomUser', Auth::user()->random);
            }
        });

        $query->when($optionNiveau, function ($query, $optionNiveau) {
            if (!empty($optionNiveau)) {
                return $query->where('niv', $optionNiveau);
            }
        });

        $FormationParticipants = $query->get();

        $Formations = Formation::where('randomUser', Auth::user()->random)
            ->where('statue', '=', '1')
            ->orderBy('nom', 'asc')
            ->get();

        $name = uniqid();
        // Créer le dossier "PayementRecus" dans le système de stockage
        Storage::disk('public')->makeDirectory('Rapports/EtudientRapport');

        $filename = 'Rapports/EtudientRapport/' . $name . '.pdf';

        $identify =  Identify::where('randomUser', '=', Auth::user()->random)->value('logo');

        // Générer le PDF en utilisant le chemin absolu pour l'image
        Pdf::loadView('print.EtudientRapport', compact('FormationParticipants', 'identify', 'optionAnneescolaire', 'Formations'))
            ->save($fileroute = storage_path('app/public/' . $filename));

        // Retourner le fichier PDF
        return response()->file($fileroute);
        // return view('print.EtudientRapport', compact('FormationParticipants', 'optionAnneescolaire'));
    }
    public function EnseignantRapportCreate()
    {
        $Enseigants = Enseigant::where('randomUser', Auth::user()->random)->get();

        $name = uniqid();
        // Créer le dossier "PayementRecus" dans le système de stockage
        Storage::disk('public')->makeDirectory('Rapports/EnseigantRapport');

        $filename = 'Rapports/EnseigantRapport/' . $name . '.pdf';

        $identify =  Identify::where('randomUser', '=', Auth::user()->random)->value('logo');

        // Générer le PDF en utilisant le chemin absolu pour l'image
        Pdf::loadView('print.EnseigantRapport', compact('Enseigants', 'identify'))
            ->save($fileroute = storage_path('app/public/' . $filename));

        // Retourner le fichier PDF
        return response()->file($fileroute);
    }
}
