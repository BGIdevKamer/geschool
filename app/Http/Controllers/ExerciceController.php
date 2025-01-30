<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercice;
use App\Models\Cour;
use App\Models\Choix;
use App\Models\Formation;
use App\Models\Module;
use App\Models\ExerciceParticipant;
use App\Models\FormationParticipant;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class ExerciceController extends Controller
{
    public function Exercice()
    {
        $userRandom = Auth::user()->random;
        $Cours = Cour::where('randomUser', '=', $userRandom)->get();
        $Modules = Module::where('randomUser', '=', $userRandom)->get();
        $Formations = Formation::where('randomUser', '=', $userRandom)
            ->where('EnLigne', '=', '1')->get();
        return view('EnregistrementExercices', compact('Formations', 'Cours', 'Modules'));
    }
    public function addExercice(Request $request)
    {
        $request->validate(
            [
                'libeller' => 'required',
                'time' => 'required',
                'desc' => 'required',
                'cfm' => 'required',
                'idcfm' => 'required',
            ],
        );

        $select = $request->cfm;
        $userRandom = Auth::user()->random;

        if ($select == 0) {
            $module = Module::where("id", $request->idcfm)
                ->where("randomUser", $userRandom)
                ->exists();
            if ($module) {
                $cour_id = 0;
                $formation_id = 0;
                $module_id = $request->idcfm;
            } else {
                $message = 'Erreur de selection veillez faire correspondre les valeurs selectionnez pour Formation/Cour/module';
                return response()->json([
                    'status' => 'exists',
                    'message' => $message,
                ]);
            }
        } elseif ($select == 1) {
            $formation = Formation::where("id", $request->idcfm)
                ->where("randomUser", $userRandom)
                ->exists();
            if ($formation) {
                $cour_id = 0;
                $formation_id = $request->idcfm;
                $module_id = 0;
            } else {
                $message = 'Erreur de selection veillez faire correspondre les valeurs selectionnez pour Formation/Cour/module';
                return response()->json([
                    'status' => 'exists',
                    'message' => $message,
                ]);
            }
        } else {
            $cour = Cour::where("id", $request->idcfm)
                ->where("randomUser", $userRandom)
                ->exists();
            if ($cour) {
                $cour_id = $request->idcfm;
                $formation_id = 0;
                $module_id = 0;
            } else {
                $message = 'Erreur de selection veillez faire correspondre les valeurs selectionnez pour Formation/Cour/module';
                return response()->json([
                    'status' => 'exists',
                    'message' => $message,
                ]);
            }
        }

        $Exercices = new Exercice();
        $Exercices->libeller = $request->libeller;
        $Exercices->description = $request->desc;
        $Exercices->duree = $request->time;
        $Exercices->cour_id = $cour_id;
        $Exercices->formation_id = $formation_id;
        $Exercices->module_id = $module_id;
        $Exercices->save();

        return response()->json([
            'status' => 'success',
            'idExercices' => $Exercices->id,
        ]);
    }

    public function addQuestion(Request $request)
    {
        $request->validate(
            [
                'question' => 'required',
                'idEx' => 'required',
            ],
            [
                'question.required' => 'Veillez reseignez une question',
            ]
        );

        $question = new Question();
        $question->Question = $request->question;
        $question->exercice_id = $request->idEx;
        $question->save();

        $questions = Question::where('id', '=', $question->id)->get();

        return response()->json([
            'status' => 'success',
            'questions' => $questions,
        ]);
    }



    public function addChoix(Request $request)
    {
        $request->validate(
            [
                'libellerChoix' => 'required',
                'idQuestion' => 'required',
                'iscorect' => 'required',
            ],
            [
                'libellerChoix.required' => 'Veillez reseignez le libeller du choix',
                'iscorect.required' => 'reseignez si le choix est correcte ou pas',
            ]
        );

        $Choix = new Choix();
        $Choix->is_correct = $request->iscorect;
        $Choix->content = $request->libellerChoix;
        $Choix->question_id = $request->idQuestion;
        $Choix->save();

        $Choixes = Choix::where('id', '=', $Choix->id)->get();

        return response()->json([
            'status' => 'success',
            'Choixes' => $Choixes,
        ]);
    }


    public function ConfigExercices(Request $request, $id)
    {
        $Exercice = Exercice::where('id', '=', $id)->get();
        return view('ConfigExercices', compact('Exercice'));
    }
    public function ExerciceView($id)
    {
        $idAuth = Auth()->guard('participant')->user()->id;

        $CountExercice = ExerciceParticipant::where('exercice_id', '=', $id)
            ->where('participant_id', '=', $idAuth)->count();

        $selectScore = ExerciceParticipant::where('exercice_id', '=', $id)
            ->where('participant_id', '=', $idAuth)->value('score');

        if ($CountExercice == 0) {
            $ExerciceParticipant = new ExerciceParticipant();
            $ExerciceParticipant->participant_id = $idAuth;
            $ExerciceParticipant->exercice_id = $id;
            $ExerciceParticipant->save();
        }

        $Exercice = Exercice::where('id', $id)->get();

        return view('participant.Exercices', compact('CountExercice', 'selectScore', 'Exercice'));
    }
    public function QuizForm(Request $request)
    {
        $id = $request->idExercice;

        $idAuth = Auth()->guard('participant')->user()->id;

        $Verif = ExerciceParticipant::where('exercice_id', '=', $id)
            ->where('participant_id', '=', $idAuth)->value('score');

        if (empty($Verif)) {
            $Questions = Question::where('exercice_id', $id)->with('Choixes')->get();
            $score = 0;

            foreach ($Questions as $question) {
                $userAnswer = $request->input('question_' . $question->id);
                if ($userAnswer) {
                    $correctChoice = $question->Choixes()->where('is_correct', '=', '1')->first();
                    if ($correctChoice && $correctChoice->id == $userAnswer) {
                        $score++;
                    }
                }
            }

            ExerciceParticipant::where('exercice_id', $id)->where('participant_id', $idAuth)->update([
                'score' => $score,
            ]);
            return response()->json([
                'status' => 'success',
                'score' => $score,
            ]);
        } else {
            return response()->json([
                'status' => 'echec',
            ]);
        }
    }
    public function EvaluationsExercices()
    {
        $userRandom = Auth::user()->random;
        $formations = Formation::where('randomUser', '=', $userRandom)->get();
        return view('EvaluationsExercices', compact('formations'));
    }
    public function EvaluationsParticipant()
    {
        $id = Auth()->guard('participant')->user()->id;
        $FormationParticipants =  FormationParticipant::where('participant_id', $id)->orderBy('created_at', 'desc')->get();
        $data = [];
        foreach ($FormationParticipants as $FormationParticipant) {
            $counts = Exercice::where('exercices.formation_id', 0)
                ->where('exercices.cour_id', 0)
                ->join('modules', 'modules.id', '=', 'exercices.module_id')
                ->where('modules.formation_id', $FormationParticipant->formation_id)
                ->count();
            $Composer = ExerciceParticipant::join('exercices', 'exercices.id', '=', 'exercice_participants.exercice_id')
                ->where('exercices.formation_id', 0)
                ->where('exercices.cour_id', 0)
                ->join('modules', 'modules.id', '=', 'exercices.module_id')
                ->where('modules.formation_id', $FormationParticipant->formation_id)
                ->count();
            if ($Composer != 0) {
                $div = ($Composer / $counts) * 100;
            } else {
                $div = 0;
            }
            $data[$FormationParticipant->id] = $div;
        }
        return view('participant.Evaluations-Participant', compact('FormationParticipants', 'data'));
    }
}
