<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Illuminate\Http\Request;
use App\Models\Participant;
use App\Models\FormationParticipantPayement;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class participantController extends Controller
{
    public function viewFormParticipant()
    {
        $Formations = Formation::where('randomUser', Auth::user()->random)
            ->where('statue', '=', '1')->get();
        return view('EnregistrementEtudiant', compact('Formations'));
    }
    public function addParticipant(Request $request)
    {
        $request->validate(
            [
                'nom' => 'required',
                'prenom' => 'required',
                'telephone' => 'required',
                'email' => 'required|email',
                'dateN' => 'required',
                'sexe' => 'required',
                'age' => 'required',
                'cni' => 'required',
                'niveau' => 'required',
                'formation' => 'required',
                'anneescolaire' => 'required',
                'montant' => 'required',
            ],
            [
                'nom.required' => 'Veillez reseignez le champs nom',
                'prenom.required' => 'Veillez reseignez le champs prenom',
                'email.required' => 'Veillez reseignez le champs email',
                'email.email' => 'Email incorrecte',
                'dateN.required' => 'Veillez renseignez le champs naissance',
                'sexe.required' => 'Veillez choisir un sexe',
                'age.required' => 'Veillez reseignez le champs age',
                'cni.required' => 'Veillez reseignez le champs Cni',
                'nom.required' => 'Veillez reseignez le champs nom',
                'niveau.required' => 'Choisir un niveau scolaire',
                'telephone.required' => 'Veillez reseignez le numero de telephone',
                'formation.required' => 'Veillez reseignez une formation',
                'anneescolaire.required' => 'Veillez reseignez une scolaire',
                'montant.required' => 'Veillez reseignez le montant pour l\'inscription',
            ]
        );

        $userRandom = Auth::user()->random;
        $participant = new Participant();
        $participant->nom = $request->nom;
        $participant->prenom = $request->prenom;
        $participant->telephone = $request->telephone;
        $participant->email = $request->email;
        $participant->dateN = $request->dateN;
        $participant->sexe = $request->sexe;
        $participant->age = $request->age;
        $participant->NiveauScolaire = $request->niveau;
        $participant->cni = $request->cni;
        $participant->randomUser = $userRandom;
        $participant->save();

        $formation = Formation::find($request->formation);

        $formation->Participants()->attach($participant, [
            'anneeScolaire' => $request->anneescolaire,
        ]);

        $Payement = new FormationParticipantPayement();
        $Payement->montant = $request->montant;
        $Payement->pay_date = Carbon::now();
        $Payement->participant_id = $participant->id;
        $Payement->formation_id = $request->formation;
        $Payement->save();


        return response()->json([
            'status' => 'success',
        ]);
    }
    public function Listeparticiapants()
    {
        $participant = Participant::where('randomUser', Auth::user()->random)->get();
        $Formations = Formation::where('randomUser', Auth::user()->random)
            ->where('statue', '=', '1')->get();
        return view('ListeEtudiants', compact('participant', 'Formations'));
        dd($Formations);
    }
    public function deleteParticipant(Request $request)
    {
        $request->validate(
            [
                'id' => 'required',
            ],
            [
                'id.required' => 'Une erreur a survenue',
            ]
        );

        $participant = Participant::find($request->id);
        $participant->delete();

        return response()->json([
            'status' => "success",
        ]);
    }
    public function UpdateParticipant(Request $request)
    {
        return response()->json([
            'status' => "success",
        ]);
    }
}
