<?php

namespace App\Http\Controllers;

use App\Models\Salle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SalleController extends Controller
{
    public function index()
    {
        $userRandom = Auth::user()->random;
        $salles = Salle::where('randomUser', $userRandom)->get();
        return view('Salles', compact('salles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'place' => 'required',
            'description' => 'required',
        ]);
        $userRandom = Auth::user()->random;
        $salle = new Salle();
        $salle->nom = $request->nom;
        $salle->places = $request->place;
        $salle->description = $request->description;
        $salle->randomUser =  $userRandom;
        $salle->save();

        return redirect()->route('index.Salles')->with('success', 'Salle enregistrer avec success !');
    }
    public function deleteSalle(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $salle = Salle::find($request->id);

        if ($salle->delete()) {
            return redirect()->route('index.Salles')->with('success', 'Salle supprimer avec success !');
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'nomSalle' => 'required',
            'placeSalle' => 'required',
            'descriptionSalle' => 'required',
            'salleId' => 'required',
        ]);

        Salle::where('id', $request->salleId)->update([
            'nom' => $request->nomSalle,
            'places' => $request->placeSalle,
            'description' => $request->description,
        ]);

        return redirect()->route('index.Salles')->with('success', 'Salle modifier avec success !');
    }
}
