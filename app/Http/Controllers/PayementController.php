<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Formation;
use App\Models\Participant;
use App\Models\Payement;
use App\Models\Tranche;
use App\Models\Invoice;
use App\Models\Years;
use App\Models\Identify;
use App\Models\FormationParticipant;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use FontLib\Table\Type\name;
use Illuminate\Support\Facades\Storage;

class PayementController extends Controller
{
    public function PayementIndex()
    {

        $userRandom = Auth::user()->random;
        $participants =  Participant::where('randomUser', '=', $userRandom)->get();
        $Years = Years::where('randomUser', '=', $userRandom)->where('active', 1)->value('Years');
        return view('EnregistrementPayement', compact('participants', 'Years'));
    }
    public function addPayement(Request $request)
    {
        $request->validate(
            [
                'FormationPayement' => 'required',
                'montant' => 'required'
            ]
        );

        $SumPayement = Payement::where('formation_participant_id', '=', $request->FormationPayement)->sum('montant');
        $sum = $SumPayement + $request->montant; // total avec nouveau payement
        $FormationParticipant = FormationParticipant::find($request->FormationPayement);
        $formationPrix =  $FormationParticipant->Formation->prix; // total de mla formation
        $reste =  $formationPrix - $sum; // a commanter
        $Tranches = Tranche::where('formation_id', '=', $FormationParticipant->Formation->id)->get();
        if (count($Tranches) == 0) {
            return redirect()->route('Payement.index')->with('err', 'Veiller d\'abord renseigner les tranches de cette formation');
        }
        $motif = "";

        if ($SumPayement < $formationPrix && $sum <=  $formationPrix) {
            $total = 0;
            foreach ($Tranches as $Tranche) {
                $total += $Tranche->montant;
                if ($sum < $total) {
                    $motif = "Avance $Tranche->libeller";
                    break;
                } elseif ($sum ==  $total) {
                    $motif = $Tranche->libeller;
                    break;
                }
            }
        } else {
            return redirect()->route('Payement.index')->with('err', 'La scolariter de ce participant est solder ou le montant entrer est supperieur au reste à payer');
        }

        $payement =  new Payement();
        $payement->formation_participant_id = $request->FormationPayement;
        $payement->note = $request->notes;
        $payement->montant = $request->montant;
        $payement->motif = $motif;
        $payement->pay_date = Carbon::now();
        $payement->save();

        return redirect()->route('Payement.index')->with([
            'success' => $payement->id,
        ]);
    }
   public function printPayement($id)
{
    $userRandom = Auth::user()->random;

    $identify = Identify::where('randomUser', '=', $userRandom)->get();
    $payPrint = Payement::where('id', '=', $id)->get();
    $payement = Payement::find($id);

    $prix = $payement->FormationParticipant->Formation->prix;
    $payementTotal = Payement::where('formation_participant_id', $payement->formation_participant_id)->sum('montant');
    $reste = $prix - $payementTotal;

    $filename = 'PayementRecus/' . $id . '.pdf';

    // ✅ Récupérer le logo de l’utilisateur depuis S3 et l’encoder en Base64
    $logoBase64 = null;
    if (Auth::user()->logo && Storage::disk('private')->exists(Auth::user()->logo)) {
        $logoContent = Storage::disk('private')->get(Auth::user()->logo);
        $logoMime = Storage::disk('private')->mimeType(Auth::user()->logo);
        $logoBase64 = 'data:' . $logoMime . ';base64,' . base64_encode($logoContent);
    }

    // Générer le PDF avec le logo en Base64
    $pdf = Pdf::loadView('print.payement-recus', compact('payPrint', 'reste', 'identify', 'prix', 'logoBase64'))
        ->setPaper([0, 0, 400, 500], 'landscape')
        ->output();

    // Sauvegarder sur S3
    Storage::disk('private')->put($filename, $pdf, 'public');

    // Générer un lien temporaire de téléchargement
    $url = Storage::disk('private')->temporaryUrl($filename, now()->addMinutes(10));

    return redirect($url);
}


    public function PayementsDelete(Request $request)
    {
        $request->validate([
            'id_payement' => 'required|integer',
            'participant_id_payement' => 'required|integer',
        ]);

        $Payement = Payement::find($request->id_payement);

        if ($Payement->delete()) {
            return redirect()->route('Participant.Detail', ['id' => $request->participant_id_payement])->with('success', 'Le Payement a été supprimer avec success!');
        }
    }
}
