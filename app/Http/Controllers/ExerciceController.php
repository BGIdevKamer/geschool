<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercice;
use App\Models\Cour;
use App\Models\Choix;
use App\Models\Formation;
use App\Models\ExerciceParticipant;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class ExerciceController extends Controller
{
    public function Exercice()
    {
        $userRandom = Auth::user()->random;
        $Cours = Cour::where('randomUser', '=', $userRandom)->get();
        $Formations = Formation::where('randomUser', '=', $userRandom)
            ->where('EnLigne', '=', '1')->get();
        return view('EnregistrementExercices', compact('Formations', 'Cours'));
    }
    public function addExercice(Request $request)
    {
        $request->validate(
            [
                'cour' => 'required',
                'libeller' => 'required',
                'time' => 'required',
                'desc' => 'required',
            ],
            [
                'cour.required' => 'Veillez reseignez un cour',
                'time.required' => 'Veillez reseignez la durée pour l\'exercice',
                'desc.required' => 'Veillez reseignez une description',
            ]
        );
        $Exercices = new Exercice();
        $Exercices->libeller = $request->libeller;
        $Exercices->description = $request->desc;
        $Exercices->duree = $request->time;
        $Exercices->cour_id = $request->cour;
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
}
