<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Illuminate\Http\Request;
use App\Models\Participant;
use App\Models\FormationParticipant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

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
                'email' => 'nullable|email|unique:' . Participant::class,
                'dateN' => 'required',
                'sexe' => 'required',
                'age' => 'required',
                'formation' => 'required',
            ],
            [
                'nom.required' => 'Veillez reseignez le champs nom',
                'prenom.required' => 'Veillez reseignez le champs prenom',
                'email.email' => 'Email incorrecte',
                'email.unique' => 'Email Deja existant',
                'dateN.required' => 'Veillez renseignez le champs naissance',
                'sexe.required' => 'Veillez choisir un sexe',
                'age.required' => 'Veillez reseignez le champs age',
                'nom.required' => 'Veillez reseignez le champs nom',
                'telephone.required' => 'Veillez reseignez le numero de telephone',
                'formation.required' => 'Veillez reseignez une formation',
            ]
        );

        // function generateToken()
        // {
        //     $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        //     $token = str_shuffle($chars);
        //     return substr($token, 0, 8) . substr($token, 26, 2);
        // }

        // $token = "abdel12345";

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

        // $formation = Formation::find($request->formation);

        // $formation->Participants()->attach($participant->id, [
        //     'anneeScolaire' => $request->anneescolaire,
        //     'niv' => $request->niv,
        // ]);

        $FormationParticipant = new FormationParticipant();
        $FormationParticipant->participant_id = $participant->id;
        $FormationParticipant->formation_id = $request->formation;
        $FormationParticipant->formation_id = $request->formation;
        $FormationParticipant->anneeScolaire = $request->anneescolaire;
        $FormationParticipant->niv = $request->niv;
        $FormationParticipant->save();

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
        $request->validate(
            [
                'nom' => 'required',
                'prenom' => 'required',
                'telephone' => 'required',
                'email' => 'required|email',
                'dateN' => 'required',
                'sexe' => 'required',
                'age' => 'required',
                'niveau' => 'required',
                'id' => 'required',
            ],
            [
                'nom.required' => 'Veillez reseignez le champs nom',
                'prenom.required' => 'Veillez reseignez le champs prenom',
                'email.required' => 'Veillez reseignez le champs email',
                'email.email' => 'Email incorrecte',
                'dateN.required' => 'Veillez renseignez le champs naissance',
                'sexe.required' => 'Veillez choisir un sexe',
                'age.required' => 'Veillez reseignez le champs age',
                'nom.required' => 'Veillez reseignez le champs nom',
                'niveau.required' => 'Choisir un niveau scolaire',
                'telephone.required' => 'Veillez reseignez le numero de telephone',
            ]
        );

        Participant::where('id', $request->id)->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'dateN' => $request->dateN,
            'sexe' => $request->sexe,
            'age' => $request->age,
            'NiveauScolaire' => $request->niveau,
            'cni' => $request->cni,
        ]);

        return response()->json([
            'status' => "success",
        ]);
    }
}
