<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\Emploie;
use App\Models\Session;
use App\Models\Matiere;
use App\Models\Enseigant;
use App\Models\Salle;
use App\Models\Heure;
use App\Models\Identify;
use App\Models\Years;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

use function PHPUnit\Framework\returnSelf;

class EmploieController extends Controller
{
    public function index()
    {
        $userRandom = Auth::user()->random;
        $Formations =  Formation::where('randomUser', '=', $userRandom)->get();
        $Emploies = Emploie::where('randomUser', '=', $userRandom)->get();
        $years = Years::where('randomUser', Auth::user()->random)->get();
        return view('EnregistrementEmploie', compact('Formations', 'Emploies', 'years'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required',
            'formation' => 'required',
            'anneescolaire' => 'required',
            'dates' => 'required',
        ]);

        $dateSub = explode(" - ", $request->dates);
        $userRandom = Auth::user()->random;

        // $verify = Emploie::where('formation_id', '=', $request->formation)->exists();

        if (!empty($request->niv)) {
            $verify = Emploie::where('formation_id', '=', $request->formation)
                ->where('niveau', '=', $request->niv)
                ->where('anneeScolaire', '=', $request->anneescolaire)
                ->exists();
            //verifier sur l'annee scolaire
        } else {
            $verify = Emploie::where('formation_id', '=', $request->formation)
                ->where('anneeScolaire', '=', $request->anneescolaire)
                ->exists();
            //verifier sur l'annee scolaire
        }

        if (!$verify) {
            $Emploie = new Emploie();
            $Emploie->formation_id  = $request->formation;
            $Emploie->anneeScolaire  = $request->anneescolaire;
            $Emploie->date_debut  = $dateSub[0];
            $Emploie->date_fin  = $dateSub[1];
            $Emploie->note  = $request->note;
            $Emploie->titre  = $request->titre;
            $Emploie->niveau  = $request->niv;
            $Emploie->randomUser  = $userRandom;
            $Emploie->save();

            return redirect()->route('session.Cour', [
                'id' => $Emploie->id,
            ]);
        } else {
            $Emploie = Emploie::where('formation_id', '=', $request->formation)->first();
            return redirect()->route('index.Emploie')->with([
                'success' => $Emploie->id,
            ]);
        }
    }

    public function sessionCour($id)
    {
        $userRandom = Auth::user()->random;
        $Matieres  = Matiere::where('randomUser', $userRandom)->get();
        $heures  = Heure::where('randomUser', $userRandom)->orderBy('heure_debut', 'asc')->get();
        $Enseigants  = Enseigant::where('randomUser', $userRandom)->get();
        $Salles  = Salle::where('randomUser', $userRandom)->get();
        $Emploie  = Emploie::find($id);
        $sessions = Session::where('emploie_id', $id)
            ->join('heures', 'heures.id', '=', 'sessions.heure_id')
            ->orderBy('heures.heure_debut', 'asc')
            ->orderBy('sessions.jour', 'asc')
            ->with(['Enseigant', 'Salle', 'Matiere']) // Eager 
            ->get();

        $ListeSession = Session::where('emploie_id', $id)
            ->get();

        $jours = [
            'Lundi',
            'Mardi',
            'Mercredi',
            'Jeudi',
            'Vendredi',
            'Samedi',
        ];

        return view('EngistrementSessionCour', compact('sessions', 'heures', 'Matieres', 'Salles', 'Enseigants', 'id', 'jours', 'Emploie', 'ListeSession'));
    }
    public function sessionAdd(Request $request)
    {
        $request->validate([
            'heures' => 'required',
            'emploie' => 'required',
            'cpp' => 'required',
        ]);

        if ($request->cpp == 0) {
            if (empty($request->matiere) || empty($request->Enseignant) || empty($request->salle)) {
                return redirect()->route('session.Cour', ['id' => $request->emploie])->with('success', 'Veillez renseignez la matiere, l\'enseignant et la salle pour une heure de cour !');
            }
        }

        $Enseigant = Enseigant::find($request->Enseignant);
        $Salle = salle::find($request->salle);

        $jours = [
            'Lundi',
            'Mardi',
            'Mercredi',
            'Jeudi',
            'Vendredi',
            'Samedi',
        ];

        $userRandom = Auth::user()->random;

        foreach ($request->heures as $heure) {

            $Heure = Heure::find($heure);

            $verify =  Session::where('enseigant_id', $request->Enseignant)
                ->where('jour', $request->jour)
                ->where('randomUser', $userRandom)
                ->where('heure_id', $heure)
                ->exists();

            $HeureVerify = Session::where('jour', $request->jour)
                ->where('heure_id', $heure)
                ->where('emploie_id', $request->emploie)
                ->exists();

            if ($HeureVerify == true) {
                return redirect()->route('session.Cour', ['id' => $request->emploie])->with('warning', 'Cet emploie de temps dispose deja une occupation pour le ' . $jours[$request->jour] . ' a ' . $Heure->heure_debut . 'h' . $Heure->min_debut . '-' . $Heure->heure_fin . 'h' . $Heure->min_fin . '. ');
            }

            $SalleVerify = Session::where('jour', $request->jour)
                ->where('heure_id', $heure)
                ->where('randomUser', $userRandom)
                ->where('salle_id', $request->salle)
                ->exists();

            if ($SalleVerify == true) {
                return redirect()->route('session.Cour', ['id' => $request->emploie])->with('warning', 'la salle ' . $Salle->nom . ' est occupée pour le ' . $jours[$request->jour] . ' a ' . $Heure->heure_debut . 'h' . $Heure->min_debut . '-' . $Heure->heure_fin . 'h' . $Heure->min_fin . ' .  ');
            }

            if (!$verify) {
                $sessions = new Session();
                $sessions->matiere_id = $request->matiere;
                $sessions->enseigant_id = $request->Enseignant;
                $sessions->salle_id = $request->salle;
                $sessions->emploie_id = $request->emploie;
                $sessions->heure_id = $heure;
                $sessions->cpp = $request->cpp;
                $sessions->randomUser = $userRandom;
                $sessions->jour = $request->jour;
                $sessions->save();
            } else {
                $mess = 'L\'enseignant ' . $Enseigant->nom . ' ' . $Enseigant->prenom . ' est occupée pour le ' . $jours[$request->jour] . ' a ' . $Heure->heure_debut . 'h' . $Heure->min_debut . '-' . $Heure->heure_fin . 'h' . $Heure->min_fin . ' . ';
                return redirect()->route('session.Cour', ['id' => $request->emploie])->with('warning', $mess);
            }
        }

        return redirect()->route('session.Cour', ['id' => $request->emploie])->with('success', 'Session de cour enregistrer avec succes !');
    }
    public function deleteSession(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'emploie' => 'required',
        ]);

        $session =  Session::find($request->id);

        if ($session->delete()) {
            return redirect()->route('session.Cour', ['id' => $request->emploie])->with('success', 'Session de cour supprimer avec succes !');
        }
    }

    public function heureDeCour()
    {
        $userRandom = Auth::user()->random;
        $heures = Heure::where('randomUser', $userRandom)->get();
        return view('HeureDeCour', compact('heures'));
    }
    public function storeHeure(Request $request)
    {
        $request->validate([
            'heure_debut' => 'required',
            'heure_fin' => 'required',
        ]);

        $heuresDebut = explode(':', $request->heure_debut);
        $heuresFin = explode(':', $request->heure_fin);
        $userRandom = Auth::user()->random;
        $heure = new Heure();
        $heure->heure_debut = $heuresDebut[0];
        $heure->min_debut = $heuresDebut[1];
        $heure->heure_fin = $heuresFin[0];
        $heure->min_fin = $heuresFin[1];
        $heure->randomUser = $userRandom;
        $heure->save();

        return redirect()->route('heure.DeCour')->with('success', 'Heure de cour enregistrer avec succes !');
    }

    public function deleteHeure(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $heure = Heure::find($request->id);

        if ($heure->delete()) {
            return redirect()->route('heure.DeCour')->with('success', 'Heure de cour supprimer avec succes !');
        }
    }
    public function ImpressionEmploie($id)
    {

        $userRandom = Auth::user()->random;

        $jours = [
            'Lundi',
            'Mardi',
            'Mercredi',
            'Jeudi',
            'Vendredi',
            'Samedi',
        ];

        $sessions = Session::where('emploie_id', $id)
            ->join('heures', 'heures.id', '=', 'sessions.heure_id')
            ->orderBy('heures.heure_debut', 'asc')
            ->orderBy('sessions.jour', 'asc')
            ->with(['Enseigant', 'Salle', 'Matiere'])
            ->get()
            ->groupBy('heure_id');


        $heures = Heure::where('randomUser', $userRandom)
            ->orderBy('heure_debut', 'asc')
            ->get();

        $Emploie = Emploie::find($id);

        $information = Identify::where('randomUser', $userRandom)->value('logo');

        $pdf = PDF::loadView('print.emploieDeTemps', compact('heures', 'sessions', 'Emploie', 'information'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream();
    }
    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ]);

        $Emploie = Emploie::find($request->id);

        if ($Emploie->delete()) {
            return redirect()->route('index.Emploie')->with('destroy', 'Emploie de temps supprimer avec succes !');
        }
    }
    public function update(Request $request)
    {
        $request->validate([
            'titreUpdate' => 'required',
            'idUpdate' => 'required',
            'formationUpdate' => 'nullable|integer',
            'anneescolaireUpdatate' => 'nullable',
            'datesUpdate' => 'required',
            'noteUpdate' => 'nullable',
        ]);

        $dateSub = explode(" - ", $request->datesUpdate);
        $emploie = Emploie::find($request->idUpdate);

        if (!empty($request->nivUpdate)) {
            $verify = Emploie::where('formation_id', '=', $request->formationUpdate)
                ->where('niveau', '=', $request->nivUpdate)
                ->where('anneeScolaire', '=', $request->anneescolaireUpdatate)
                ->exists();
            //verifier sur l'annee scolaire
        } else {
            $verify = Emploie::where('formation_id', '=', $request->formationUpdate)
                ->where('anneeScolaire', '=', $request->anneescolaireUpdatate)
                ->exists();
            //verifier sur l'annee scolaire
        }

        if (empty($request->formationUpdate)) {
            $formation = $emploie->formation_id;
        } else {
            $formation = $request->formationUpdate;
        }

        if (empty($request->anneescolaireUpdatate)) {
            $anneeScolaire = $emploie->anneeScolaire;
        } else {
            $anneeScolaire = $request->anneescolaireUpdatate;
        }

        if (empty($request->nivUpdate)) {
            $niv = $emploie->niveau;
        } else {
            $niv = $request->nivUpdate;
        }

        if (!$verify) {
            Emploie::where('id', $request->idUpdate)->update([
                'formation_id' => $formation,
                'anneeScolaire' => $anneeScolaire,
                'date_debut' => $dateSub[0],
                'date_fin' => $dateSub[1],
                'note' => $request->noteUpdate,
                'titre' => $request->titreUpdate,
                'niveau' => $niv,
            ]);
            return redirect()->route('index.Emploie')->with('destroy', 'Emploie de temps Modifier avec succes !');
        } else {
            $Emploie = Emploie::where('formation_id', '=', $request->formationUpdate)->first();
            return redirect()->route('index.Emploie')->with([
                'success' => $Emploie->id,
            ]);
        }
    }
}
