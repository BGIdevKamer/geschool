<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Participant;
use App\Models\Formation;
use App\Models\Courriel;
use App\Models\User;
use App\Models\FormationParticipant;

class AuthController extends Controller
{
    public function Login(Request $request)
    {
        $request->validate(
            [
                'identifier' => 'required|string',
                'password' => 'required|string',
            ]
        );


        $field = filter_var($request->identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'telephone';
        $credentials = [$field => $request->identifier, 'password' => $request->password];
        if (Auth::guard('participant')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('participant.dashboard'));
        }
    }
    public function registerParticipant(Request $request)
    {
        $request->validate(
            [
                'email' => 'email|unique:' . Participant::class,
                'telephone' => 'required',
                'password' => 'required',
                'nom' => 'required|string',
                'prenom' => 'required|string',
                'gender' => 'required|string',
                'naissance' => 'required',
                'age' => 'required',
                'formation' => 'required',
                'courriel' => 'required',
            ]
        );


        $random =  Formation::where('id', '=', $request->formation)->value('randomUser');
        $userId =  User::where('random', '=', $random)->first()->value('id');

        $participant = new Participant();
        $participant->nom = $request->nom;
        $participant->prenom = $request->prenom;
        $participant->telephone = $request->telephone;
        $participant->email = $request->email;
        $participant->dateN = $request->naissance;
        $participant->sexe = $request->gender;
        $participant->age = $request->age;
        $participant->password = Hash::make($request->password);
        $participant->randomUser = $random;
        $participant->save();

        $Courriel = new Courriel();
        $Courriel->participant_id = $participant->id;
        $Courriel->user_id = $userId;
        $Courriel->sujet = "ASK";
        $Courriel->Message = $request->courriel;
        $Courriel->is_View = '0';
        $Courriel->save();

        $field = 'email';
        $credentials = [$field => $request->email, 'password' => $request->password];
        if (Auth::guard('participant')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('participant.dashboard'));
        }
    }
    public function inscription($keys)
    {
        $formations = Formation::where('randomUser', $keys)
            ->get();
        return view('participant.auth.register', compact('formations'));
    }
    public function dashboardParticipant()
    {
        $id = Auth()->guard('participant')->user()->id;
        $countFormation =  FormationParticipant::where('participant_id', '=', $id)->count();
        return view('participant.Dashboard', compact('countFormation'));
    }
    public function dashboardVue()
    {
        $userRandom = Auth::user()->random;
        $formations = Formation::where('randomUser', $userRandom)->get();
        return view('dashboard', compact('formations'));
    }
    public function deconnxion(Request $request)
    {
        Auth::guard('participant')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/Participant-login');
    }
}
