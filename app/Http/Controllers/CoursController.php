<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\Module;
use App\Models\FormationParticipant;
use App\Models\Piece;
use App\Models\Cour;
use App\Models\Exercice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CoursController extends Controller
{
    public function ViewCour()
    {
        $userRandom = Auth::user()->random;
        $formations = Formation::where('randomUser', $userRandom)
            ->where('EnLigne', '=', '1')->get();
        return view('EnregistrementCour', compact('formations'));
    }
    public function addCour(Request $request)
    {
        $request->validate(
            [
                'libeller' => 'required',
                'num' => 'required',
                'video' => 'required|file|max:307200',
                'state' => 'required',
                'desc' => 'required',
                'desc' => 'required',
                'content' => 'required',
            ],
            [
                'libeller.required' => 'Veillez reseignez le nom de du cour',
                'num.required' => 'Veillez reseignez un numero pour le cour',
                'video.required' => 'Ajouter une video',
                'state.required' => 'Choisir une formation pour ce cour',
                'desc.required' => 'Ajouter une description courte',
                'content.required' => 'Ajouter le contenue textuel de la formation',
            ]
        );

        $file = $request->file('video');
        $nameVideo = storage::disk('public')->put('FormationVideo', $file);
        $nameMiniature = storage::disk('public')->put('Miniatures', $request->miniature);
        $userRandom = Auth::user()->random;

        $Cour = new Cour();
        $Cour->libeller = $request->libeller;
        $Cour->numero = $request->num;
        $Cour->desc = $request->desc;
        $Cour->module_id = $request->state;
        $Cour->videoLink = $nameVideo;
        $Cour->imgLink = $nameMiniature;
        $Cour->Content = $request->content;
        $Cour->youtubeid = $request->deofile;
        $Cour->randomUser =  $userRandom;
        $Cour->save();

        return response()->json([
            'status' => 'success',
            'idCour' => $Cour->id,
        ]);

        // $IdCour = $Cour->id;
        // $Pieces = $request->file('pieces');
        // // dd($Pieces);

        // foreach ($Pieces as $Piece) {
        //     $extension = $Piece->getClientOriginalExtension();
        //     $namePiece = storage::disk('public')->put('PiecesJointe', $Piece);

        //     // $Piece = new Piece();
        //     // $Piece->extention = $extension;
        //     // $Piece->cour_id = $namePiece;
        //     // $Piece->link = $IdCour;
        //     // $Piece->save();
        // }

        // dd('finit');
    }
    public function addPieces(Request $request)
    {
        $Pieces = $request->file('pieces');
        $IdCour = $request->IdCour;

        foreach ($Pieces as $Piece) {
            $extension = $Piece->getClientOriginalExtension();
            $namePiece = storage::disk('public')->put('PiecesJointe', $Piece);

            $Piece = new Piece();
            $Piece->extension = $extension;
            $Piece->cour_id = $IdCour;
            $Piece->link = $namePiece;
            $Piece->save();
        }
    }
    public function ListeCours()
    {
        $userRandom = Auth::user()->random;
        $formations = Formation::where('randomUser', $userRandom)
            ->where('EnLigne', '=', '1')->get();
        return view('ListeCours', compact('formations'));
    }
    public function CourDetails($id)
    {
        $cours = Cour::where('id', '=', $id)->get();
        return view('DetailsCour', compact('cours'));
    }

    public function download(Request $request, $file)
    {
        $fileRoute = Piece::where('id', '=', $file)->value('link');
        if (Storage::disk('public')->exists($fileRoute)) {
            return Storage::disk('public')->download($fileRoute);
        }
        abort(404);
    }
    public function deleteCour(Request $request, $id)
    {
        $pieces = Piece::where('cour_id', '=', $id)->get();
        $Exercices = Exercice::where('cour_id', '=', $id)->get();
        foreach ($Exercices as $exercice) {
            $exercice->delete();
        }
        foreach ($pieces as $piece) {
            $piece->delete();
        }
        $cour = Cour::find($id);
        $cour->delete();
        return redirect()->route('Liste.cours');
    }
    public function ParticipantCours()
    {
        $id = Auth()->guard('participant')->user()->id;
        $FormationParticipant =  FormationParticipant::where('participant_id', $id)
            ->orderBy('created_at', 'desc')->get();
        return view('participant.Liste-Cours', compact('FormationParticipant'));
    }
    public function ParticpantCour($id)
    {
        $cours = Cour::where('id', '=', $id)->get();
        return view('participant.Details-Cour', compact('cours'));
    }

    public function ModuleVue($id)
    {
        // $userRandom = Auth::user()->random;
        $cours = Cour::where('module_id', $id)->paginate(5);
        $Module = Module::find($id);
        $Exercices = Exercice::where('module_id', $id)->get();
        $Modules = Module::where("formation_id", $Module->formation_id)->limit(6)->get();
        return view('moduleCours', compact('cours', 'Module', 'Modules', 'Exercices'));
    }
    public function UpdateCour($id)
    {
        $cour = Cour::find($id);
        $userRandom = Auth::user()->random;
        $formations = Formation::where('randomUser', $userRandom)
            ->where('EnLigne', '=', '1')->get();
        return view('UpdateCour', compact('cour', 'formations'));
    }
    public function deleteImage($id)
    {
        $Path =  Cour::where('id', $id)->value('imgLink');
        $filePath =  storage_path('app/public/' . $Path);
        Storage::delete($filePath);
        Cour::where('id', $id)->update([
            'imgLink' => "",
        ]);
        return redirect()->route('Update.cour', ['id' => $id])->with('success', 'L\'image a bien ete supprimer');
    }
    public function deleteVideo($id)
    {
        $Path =  Cour::where('id', $id)->value('videoLink');
        $filePath =  storage_path('app/public/' . $Path);
        Storage::delete($filePath);
        Cour::where('id', $id)->update([
            'videoLink' => "",
        ]);
        return redirect()->route('Update.cour', ['id' => $id])->with('success', 'La video a bien ete supprimer');
    }
    public function ModifyCour(Request $request){
        $request->validate(
            [
                'libeller' => 'required',
                'num' => 'required',
                'video' => 'nullable|file|max:307200',
                'state' => 'required',
                'desc' => 'required',
                'miniature' => 'nullable',
                'content' => 'required',
                'id' => 'required',
            ],
            [
                'libeller.required' => 'Veillez reseignez le nom de du cour',
                'num.required' => 'Veillez reseignez un numero pour le cour',
                'video.required' => 'Ajouter une video',
                'state.required' => 'Choisir une formation pour ce cour',
                'desc.required' => 'Ajouter une description courte',
                'content.required' => 'Ajouter le contenue textuel de la formation',
            ]);
            if(empty($request->content)){
                $content = Cour::where('id',$request->id)->value('Content');
            }else{
                $content = $request->content; 
            }

            if(empty($request->video)){
                $video = Cour::where('id',$request->id)->value('videoLink');
            }else{
                $video = $request->video; 
            }

            if(empty($request->miniature)){
                $miniature = Cour::where('id',$request->id)->value('imgLink');
            }else{
                $miniature = $request->video; 
            }

            Cour::where('id',$request->id)->update([
                'numero' => $request->num,
                'libeller' => $request->libeller,
                'desc' => $request->desc,
                'module_id' => $request->state,
                'videoLink' => $video,
                'imgLink' => $miniature,
                'youtubeid' => $request->deofile,
                'Content' =>  $content,
            ]);

        return redirect()->route('Module.Vue',['id'=>$request->state])->with('success', 'Cour modifier avec success.');
            
    }
}
