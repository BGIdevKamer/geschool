<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class FormationController extends Controller
{
    public function addFormation(Request $request){
        $request->validate(
            [
                'name'=>'required',
                'duree'=>'required',
                'prix'=>'required',
            ],
            [
                'name.required'=>'Veillez reseignez le nom de la formation',
                'duree.required'=>'Veillez reseignez la durée de la formation',
                'prix.required'=>'Veillez reseignez le prix de la formation',
            ]
            );
            
            $userRandom = Auth::user()->random;
            $formation = new Formation();
            $formation->nom = $request->name;
            $formation->durée = $request->duree;
            $formation->note = $request->note;
            $formation->prix = $request->prix;
            $formation->Niveau_requie = $request->prerequit;
            $formation->EnLigne = "0";
            $formation->randomUser =  $userRandom;
            $formation->statue =  "1";
            $formation->save();

            return response()->json([
                'status' => "success", 
             ]);
    }

    public function ListeFormation(){
        $userRandom = Auth::user()->random;
        $formations = Formation::where('randomUser',$userRandom)->get();
        return view ('listeformations',compact('formations'));
    }

    public function DeleteFormation(Request $request,$id,$statut){
        if($statut == 0){
            $newStatut = 1;
        }else{
            $newStatut = 0; 
        }
        Formation::where('id',$id)->update([
            'statue'=>$newStatut,
         ]);
         $res = "success";
         return redirect ()->route('liste.Formation')->with('success','Modification effectuées, le statut de la formation été modifier');
    }
    public function updateformation(Request $request){
        $request->validate(
            [
                'nom'=>'required',
                'duree'=>'required',
                'prix'=>'required',
            ],
            [
                'nom.required'=>'Veillez reseignez le nom de la formation',
                'duree.required'=>'Veillez reseignez la durée de la formation',
                'prix.required'=>'Veillez reseignez le prix de la formation',
            ]
        );
        if($request->enligne == 2){
            $ligne = Formation::where('id',$request->id)->value('Enligne');
        }else{
            $ligne = $request->enligne;
        }
        Formation::where('id',$request->id)->update([
            'nom'=>$request->nom,
            'durée'=>$request->duree,
            'note'=>$request->note,
            'prix'=>$request->prix,
            'Niveau_requie'=>$request->niveau,
            'EnLigne'=>$ligne
         ]);

        return response()->json([
            'status' => "success", 
         ]);

    }
}
