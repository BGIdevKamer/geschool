<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Illuminate\Support\Facades\Auth;
use App\Models\Module;
use App\Models\FormationParticipant;
use App\Models\Cour;
use App\Models\Exercice;
use Illuminate\Http\Request;

class ModuleController extends Controller
{

    public function index()
    {
        $userRandom = Auth::user()->random;
        $Formations = Formation::where('randomUser', $userRandom)->get();
        $Modules = Module::where('randomUser', $userRandom)->get();
        return view('module', compact('Formations', 'Modules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'libeller' => 'required',
            'description' => 'required',
            'formation' => 'required',
        ]);

        $userRandom = Auth::user()->random;
        $module = new module();
        $module->libeller = $request->libeller;
        $module->description = $request->description;
        $module->formation_id = $request->formation;
        $module->randomUser = $userRandom;
        $module->save();

        return redirect()->route('Module.index')->with('success', 'Moule enregistrer avec succes !');
    }
    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $module = Module::find($request->id);
        if ($module->delete()) {
            return redirect()->route('Module.index')->with('success', 'Module supprimer avec succes !');
        }
    }
    public function update(Request $request)
    {
        $request->validate([
            'idupdate' => 'required',
            'updatelibeller' => 'required',
            'updatedescription' => 'required',
            'ancienneValue' => 'required',
        ]);

        if (empty($request->updateformation)) {
            $formation = $request->ancienneValue;
        } else {
            $formation = $request->updateformation;
        }

        Module::where('id', $request->idupdate)->update([
            'libeller' => $request->updatelibeller,
            'description' => $request->updatedescription,
            'formation_id' =>  $formation,
        ]);

        return redirect()->route('Module.index')->with('success', 'Module modifier avec succes !');
    }
    public function ModuleParticipant($id)
    {
        // $id = Auth()->guard('participant')->user()->id;
        $cours = Cour::where('module_id', $id)->paginate(5);
        $Module = Module::find($id);
        $Exercices = Exercice::where('module_id', $id)->get();
        $Modules = Module::where("formation_id", $Module->formation_id)->limit(6)->get();
        return view('participant.module-Cours', compact('cours', 'Module', 'Modules', 'Exercices'));
    }
}
