<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\Tranche;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FormationController extends Controller
{
    public function addFormation(Request $request)
    {
        $request->validate(
            [
                'nom' => 'required',
                'duree' => 'nullable',
                'prix' => 'required',
                'customRadio' => 'required',
            ],
            [
                'name.required' => 'Veillez reseignez le nom de la formation',
                'duree.required' => 'Veillez reseignez la durée de la formation',
                'prix.required' => 'Veillez reseignez le prix de la formation',
            ]
        );

        $file = $request->file('miniature');

        if (!empty($file)) {
            $name = $file->store('FormationImg', 'public');
        } else {
            $name = "";
}

        $userRandom = Auth::user()->random;
        $formation = new Formation();
        $formation->nom = $request->nom;
        $formation->durée = $request->duree;
        $formation->note = $request->note;
        $formation->prix = $request->prix;
        $formation->Niveau_requie = $request->prerequit;
        $formation->EnLigne = $request->customRadio;
        $formation->randomUser =  $userRandom;
        $formation->statue =  "1";
        $formation->img =  $name;
        $formation->save();

        for ($i = 1; $i <= 4; $i++) {

            if ($i == 1) {
                $libeller = "Inscription";
                $numero = 0;
            } elseif ($i == 2) {
                $libeller = "Premier Tranche";
                $numero = 1;
            } elseif ($i == 3) {
                $libeller = "Deuxieme Tranche";
                $numero = 2;
            } elseif ($i == 4) {
                $libeller = "Troisieme Tranche";
                $numero = 3;
            }

            $nameRequest = "tranche_$i";

            $montant = $request->$nameRequest;

            if (empty($montant)) {
                $montant = "0";
            }
            $tranche = new Tranche();
            $tranche->libeller =  $libeller;
            $tranche->montant =  $montant;
            $tranche->formation_id =   $formation->id;
            $tranche->numero = $numero;
            $tranche->save();
        }

        return redirect()->route('Enregistrement.Formation')->with('success', 'Formation enregistrer avec succes');
    }

    public function ListeFormation()
    {
        $userRandom = Auth::user()->random;
        $formations = Formation::where('randomUser', $userRandom)->get();
        
        return view('listeformations', compact('formations'));
    }

    public function DeleteFormation(Request $request, $id, $statut)
    {
        if ($statut == 0) {
            $newStatut = 1;
        } else {
            $newStatut = 0;
        }
        Formation::where('id', $id)->update([
            'statue' => $newStatut,
        ]);
        $res = "success";
        return redirect()->route('liste.Formation')->with('success', 'Modification effectuées, le statut de la formation été modifier');
    }
    public function updateformation(Request $request)
    {
        $request->validate(
            [
                'nom' => 'required',
                'duree' => 'nullable',
                'prix' => 'required',
            ],
            [
                'nom.required' => 'Veillez reseignez le nom de la formation',
                'prix.required' => 'Veillez reseignez le prix de la formation',
            ]
        );

        if ($request->enligne == 2) {
            $ligne = Formation::where('id', $request->id)->value('Enligne');
        } else {
            $ligne = $request->enligne;
        }

        Formation::where('id', $request->id)->update([
            'nom' => $request->nom,
            'durée' => $request->duree,
            'note' => $request->note,
            'prix' => $request->prix,
            'Niveau_requie' => $request->niveau,
            'Enligne' => $request->enligne,
        ]);

        return response()->json([
            'status' => "success",
        ]);
    }
    public function welcome()
    {
        $formations = Formation::all();
        return view('welcome', compact('formations'));
    }
}
