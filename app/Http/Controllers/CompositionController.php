<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participant;
use App\Models\Evaluation;
use App\Models\FormationParticipant;
use App\Models\Formation;
use App\Models\Matiere;
use App\Models\Composition;
use Illuminate\Support\Facades\Auth;
use App\Models\Years;

class CompositionController extends Controller
{
    public function index()
    {
        $userRandom = Auth::user()->random;
        $participants =  Participant::where('randomUser', '=', $userRandom)->get();

        $years = Years::where('randomUser', Auth::user()->random)->get();
        $y = Years::where('randomUser', '=', $userRandom)->where('active', 1)->value('Years');

        $Evaluation =  Evaluation::where('randomUser', '=', $userRandom)->get();
        $Matiere =  Matiere::where('randomUser', '=', $userRandom)->get();
        $Formations =  Formation::where('randomUser', '=', $userRandom)->get();
        return view('Composition', compact('participants', 'Evaluation', 'Matiere', 'Formations', 'years', 'y'));
    }
    public function  addEvaluation(Request $request)
    {
        $request->validate([
            'libeller' => 'required',
        ]);

        $userRandom = Auth::user()->random;

        $Evaluation =  new Evaluation();
        $Evaluation->libeller = $request->libeller;
        $Evaluation->numero = $request->numero;
        $Evaluation->description = $request->desc;
        $Evaluation->randomUser =  $userRandom;
        $Evaluation->save();

        return redirect()->route('index.Evaluation')->with('success', 'La session d\'evaluation a ete Enregister avec success.');
    }
    public function deleteEvaluation(Request $request)
    {
        $request->validate(
            [
                'id' => 'required',
            ],
            [
                'id.required' => 'Une erreur a survenue',
            ]
        );

        $Evaluation = Evaluation::find($request->id);

        $Evaluation->delete();

        return redirect()->route('index.Evaluation')->with('success', 'La session d\'evaluation a ete supprimer avec success.');
    }
    public function addNote(Request $request)
    {
        $request->validate([
            'FormationPayement' => 'required',
            'matiere' => 'required',
            'eval' => 'required',
            'appreciation' => 'required',
            'note' => 'required',
        ]);

        $verification = Composition::where('formation_participant_id', '=', $request->FormationPayement)
            ->where('matiere_id', '=', $request->matiere)
            ->where('evaluation_id', '=', $request->eval)
            ->exists();

        if (!$verification) {
            $composition = new Composition();
            $composition->note = $request->note;
            $composition->appreciate = $request->appreciation;
            $composition->formation_participant_id = $request->FormationPayement;
            $composition->matiere_id = $request->matiere;
            $composition->evaluation_id = $request->eval;
            $composition->save();

            return redirect()->route('index.composition')->with('success', 'Enregistrement effectuées avec success');
        } else {
            return redirect()->route('index.composition')->with('err', 'Cet apprenant a deja une note pour cette evaluation');
        }
    }
    public function indexEvaluation()
    {
        $userRandom = Auth::user()->random;
        $Evaluations = Evaluation::where('randomUser', '=', $userRandom)->get();
        return view('SessionEvaluation', compact('Evaluations'));
    }
    public function udpateEvaluation(Request $request)
    {
        $request->validate([
            'libellerSession' => 'required',
            'idUpdate' => 'required',
        ]);

        Evaluation::where('id', $request->idUpdate)->update([
            'libeller' => $request->libellerSession,
            'numero' => $request->numeroSession,
            'description' => $request->descriptionSession,
        ]);

        return redirect()->route('index.Evaluation')->with('success', 'La session d\'evaluation a ete modifier avec success.');
    }
    public function InsertionNote(Request $request)
    {
        $request->validate([
            'formation' => 'required',
            'matiere_select' => 'required',
            'eval_select' => 'required',
            'anneescolaire' => 'required'
        ]);

        $FormationParticipants = FormationParticipant::where('formation_id', $request->formation)
            ->where('anneeScolaire', $request->anneescolaire)->get();

        $Evaluation =  Evaluation::find($request->eval_select);

        $Matiere =  Matiere::find($request->matiere_select);

        $Formation =  Formation::find($request->formation);

        $data[] = [];

        $data = [
            'anneescolaire' =>  $request->anneescolaire,
            'Evaluation' =>  $Evaluation->libeller,
            'formation_id' =>  $request->formation,
            'formation_libeller' =>  $Formation->nom,
        ];

        return view('InsertionNote', compact('data', 'Matiere', 'FormationParticipants', 'Evaluation'));
    }
    public function Insertion(Request $request)
    {
        $request->validate([
            'anneescolaire' => 'required',
            'Evaluation' => 'required',
            'matiere' => 'required',
            'formation' => 'required',
        ]);

        $FormationParticipants = FormationParticipant::where('formation_id', $request->formation)
            ->where('anneeScolaire', $request->anneescolaire)->get();

        // dd($FormationParticipants);

        foreach ($FormationParticipants as $FormationParticipant) {

            $verification = FormationParticipant::where('formation_participants.id', $FormationParticipant->id)
                ->join('compositions', 'compositions.formation_participant_id', 'formation_participants.id')
                ->where('compositions.matiere_id', $request->matiere)
                ->where('compositions.evaluation_id', $request->Evaluation)
                ->exists();

            if (!$verification) {

                $request_take_no = "participant_$FormationParticipant->id";
                $request_take_ap = "appreciation_$FormationParticipant->id";

                $note = $request->$request_take_no;
                $appreciation = $request->$request_take_ap;

                $composition = new Composition();
                $composition->note = $note;
                $composition->appreciate = $appreciation;
                $composition->formation_participant_id = $FormationParticipant->id;
                $composition->matiere_id = $request->matiere;
                $composition->evaluation_id = $request->Evaluation;
                $composition->save();
            }
        }
        return redirect()->route('index.composition')->with('success', 'les notes on ete enregistrez avec success.');
    }
    public function deleteComposition(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'participant_id' => 'required|integer',
        ]);

        $composition = Composition::find($request->id);

        if ($composition->delete()) {
            return redirect()->route('Participant.Detail', ['id' => $request->participant_id])->with('success', 'La note a été avec success veiller la reenregistrer si besoin');
        }
    }
}
