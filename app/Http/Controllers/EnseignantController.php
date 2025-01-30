<?php

namespace App\Http\Controllers;

use App\Models\Enseigant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EnseignantController extends Controller
{
    public function index()
    {
        $userRandom = Auth::user()->random;
        $Enseigants =  Enseigant::where('randomUser', $userRandom)->get();
        return view('Enseignant', compact('Enseigants'));
    }
    public function saveEnseignant(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'phone' => 'required',
        ]);

        $userRandom = Auth::user()->random;
        $Enseigant =  new Enseigant();
        $Enseigant->nom =  $request->nom;
        $Enseigant->prenom =  $request->prenom;
        $Enseigant->phone =  $request->phone;
        $Enseigant->email =  $request->email;
        $Enseigant->randomUser =  $userRandom;
        $Enseigant->save();

        return redirect()->route('index.Enseigant')->with('success', 'Enseignant enregistrer avec success.');
    }
    public function deleteEnseignant(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $Enseignant = Enseigant::find($request->id);
        $Enseignant->delete();
        return redirect()->route('index.Enseigant')->with('success', 'Enseignant supprimer avec success !');
    }
    public function updateEnseignant(Request $request)
    {
        $request->validate([
            'nomEnseignant' => 'required',
            'idEnseignant' => 'required',
            'prenomEnseignant' => 'required',
            'phoneEnseignant' => 'required',
        ]);

        Enseigant::where('id', $request->idEnseignant)->update([
            'nom' => $request->nomEnseignant,
            'prenom' => $request->prenomEnseignant,
            'phone' => $request->phoneEnseignant,
            'email' => $request->emailEnseignant,
        ]);

        return redirect()->route('index.Enseigant')->with('success', 'Enseignant modifier avec success !');
    }
}
