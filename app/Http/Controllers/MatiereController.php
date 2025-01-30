<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matiere;
use App\Models\Categorie;
use Illuminate\Support\Facades\Auth;

class MatiereController extends Controller
{
    public function index()
    {
        $userRandom = Auth::user()->random;
        $matieres = Matiere::where('randomUser', '=', $userRandom)->get();
        $categories = Categorie::where('randomUser', '=', $userRandom)->get();
        return view('matieres', compact('matieres', 'categories'));
    }
    public function addMatieres(Request $request)
    {
        $request->validate(
            [
                'coefs' => 'required',
                'libeller' => 'required',
            ]
        );

        $userRandom = Auth::user()->random;

        $matieres = new Matiere();
        $matieres->libeller = $request->libeller;
        $matieres->heures = $request->heure;
        $matieres->coefs = $request->coefs;
        $matieres->categorie_id = $request->categorie;
        $matieres->randomUser = $userRandom;
        $matieres->save();

        return redirect()->route('matieres.index')->with('success', 'La matieres a ete enregistrer avec success.');

        // dd($matieres);
    }
    public function deleteMatieres(Request $request)
    {
        $request->validate(
            [
                'id' => 'required',
            ],
            [
                'id.required' => 'Une erreur a survenue',
            ]
        );

        $matiere = Matiere::find($request->id);
        $matiere->delete();

        return redirect()->route('matieres.index')->with('success', 'La matiere a ete supprimer avec success.');
    }
    public function modifyMatieres(Request $request)
    {
        $request->validate([
            'upId' => 'required',
            'uplibeller' => 'required',
            'upcoefs' => 'required',
        ]);

        if (!empty($request->selectCategorie)) {
            $categories = $request->selectCategorie;
        } else {
            $categories = $request->upcategorie;
        }

        Matiere::where('id', $request->upId)->update([
            'libeller' => $request->uplibeller,
            'heures' => $request->upheure,
            'coefs' => $request->upcoefs,
            'categorie_id' => $categories,
        ]);

        return redirect()->route('matieres.index')->with('success', 'La matieres a ete modifier avec success.');
    }
    public function addCategorie(Request $request)
    {
        $request->validate([
            'categorieLibeller' => 'required'
        ]);

        $userRandom = Auth::user()->random;

        $categorie = new Categorie();
        $categorie->libeller = $request->categorieLibeller;
        $categorie->randomUser = $userRandom;
        $categorie->save();

        return redirect()->route('matieres.index')->with('success', 'La Categorie a ete enregistrer avec success.');
    }
    public function modifyCategorie(Request $request)
    {
        $request->validate([
            'upcategorieLibeller' => 'required',
            'categorieId' => 'required'
        ]);
        Categorie::where('id', $request->categorieId)->update([
            'libeller' => $request->upcategorieLibeller,
        ]);
        return redirect()->route('matieres.index')->with('success', 'La Categorie a ete modifier avec success.');
    }
    public function deleteCategorie(Request $request)
    {

        $request->validate([
            'idCategorie' => 'required',
        ]);

        $Categorie = Categorie::find($request->idCategorie);
        $Matieres = Matiere::where('categorie_id', $request->idCategorie)->get();
        foreach ($Matieres as $matiere) {
            $matiere->delete();
        }
        $Categorie->delete();

        return redirect()->route('matieres.index')->with('success', 'La Categorie a ete supprimer avec success.');
    }
}
