<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\Participant;
use App\Models\Enseigant;
use App\Models\Payement;
use App\Models\Exercice;
use App\Models\Module;
use App\Models\Cour;
use App\Models\ExerciceParticipant;
use App\Models\FormationParticipant;
use App\Models\Years;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    public function Index()
    {

        if (session('type') == "4") {
            return redirect()->route('liste.particiapants');
        }

        $year = Years::where('active', 1)
            ->where('randomUser', Auth::user()->random)
            ->value('Years');

        $formations = Formation::where('randomUser', Auth::user()->random)->count();

        $Participants = Participant::where('randomUser', Auth::user()->random)
            ->join('formation_participants', 'formation_participants.participant_id', '=', 'participants.id')
            ->where('formation_participants.anneeScolaire', $year)
            ->count();

        $Enseigants = Enseigant::where('randomUser', Auth::user()->random)->count();


        $monthlyTotals = DB::table('payements')
            ->join('formation_participants', 'payements.formation_participant_id', '=', 'formation_participants.id')
            ->join('formations', 'formation_participants.formation_id', '=', 'formations.id')
            ->where('formations.randomUser', Auth::user()->random)  // Filtrer par randomUser
            ->select(
                DB::raw('YEAR(payements.pay_date) as year'),  // Extraire l'année
                DB::raw('MONTH(payements.pay_date) as month'),  // Extraire le mois
                DB::raw('SUM(payements.montant) as total')  // Calculer la somme des montants
            )
            ->groupBy(DB::raw('YEAR(payements.pay_date)'), DB::raw('MONTH(payements.pay_date)'))  // Grouper par année et mois
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();


        $yearlyTotals = DB::table('payements')
            ->join('formation_participants', 'payements.formation_participant_id', '=', 'formation_participants.id')
            ->join('formations', 'formation_participants.formation_id', '=', 'formations.id')
            ->where('formations.randomUser', Auth::user()->random)  // Filtrer par randomUser
            ->select(
                DB::raw('YEAR(payements.pay_date) as year'),  // Extraire l'année
                DB::raw('SUM(payements.montant) as total')  // Calculer la somme des montants
            )
            ->groupBy(DB::raw('YEAR(payements.pay_date)'))  // Grouper par année
            ->orderBy('year', 'asc')
            ->get();



        $payements = Payement::join('formation_participants', 'formation_participants.id', '=', 'payements.formation_participant_id')
            ->where('formation_participants.anneeScolaire', $year)
            ->join('formations', 'formations.id', '=', 'formation_participants.formation_id')
            ->where('formations.randomUser', Auth::user()->random)
            ->sum('payements.montant');

        $totalParticipants = Participant::where('participants.randomUser', Auth::user()->random)
            ->join('formation_participants', 'formation_participants.participant_id', '=', 'participants.id')
            ->where('formation_participants.anneeScolaire', $year)
            ->count(); // Total des participants

        // Récupération des participants avec le sexe et leur nombre
        $percentage = Participant::where('participants.randomUser', Auth::user()->random)
            ->join('formation_participants', 'formation_participants.participant_id', '=', 'participants.id')
            ->where('formation_participants.anneeScolaire', $year)
            ->selectRaw('COUNT(participants.id) as count, participants.sexe')
            ->groupBy('participants.sexe')
            ->orderBy('participants.sexe', 'asc')
            ->get()
            ->map(function ($item) use ($totalParticipants) {
                // Calcul du pourcentage pour chaque sexe
                $item->percentage = ($item->count / $totalParticipants) * 100;
                return $item;
            });


        $Personnelles = User::where('random', Auth::user()->random)
            ->where('id', '!=', Auth::user()->id)
            ->get();

        return view('dashboard', compact('formations', 'Participants', 'percentage', 'Enseigants', 'payements', 'yearlyTotals', 'monthlyTotals', 'Personnelles'));
    }
    public function dashboardParticipant()
    {
        $totalExercices = Exercice::join('modules', 'modules.id', '=', 'exercices.module_id')
            ->where('modules.randomUser', Auth()->guard('participant')->user()->randomUser)->count();

        $totalModule = Module::join('formations', 'formations.id', '=', 'modules.formation_id')
            ->where('formations.randomUser', Auth()->guard('participant')->user()->randomUser)->count();

        $moy = ExerciceParticipant::join('exercices', 'exercices.id', '=', 'exercice_participants.exercice_id')
            ->join('participants', 'participants.id', '=', 'exercice_participants.participant_id')
            ->where('participants.id', Auth()->guard('participant')->user()->id)
            ->avg('exercice_participants.score');

        $VerificationForParticipant = FormationParticipant::where('participant_id', Auth()->guard('participant')->user()->id)->exists();

        $dataEvaluation = ExerciceParticipant::where('participant_id', Auth()->guard('participant')->user()->id)->get();
        return view('participant.Dashboard', compact('moy', 'totalModule', 'totalExercices', 'dataEvaluation', 'VerificationForParticipant'));
    }
}
