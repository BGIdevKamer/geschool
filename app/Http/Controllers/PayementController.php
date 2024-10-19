<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Formation;
use App\Models\Participant;
use App\Models\Payement;
use App\Models\Tranche;
use App\Models\Invoice;
use App\Models\Identify;
use App\Models\FormationParticipant;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class PayementController extends Controller
{
    public function PayementIndex()
    {

        $userRandom = Auth::user()->random;
        $participants =  Participant::where('randomUser', '=', $userRandom)->get();
        return view('EnregistrementPayement', compact('participants'));
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
        $reste =  $formationPrix - $sum;
        $Tranches = Tranche::where('formation_id', '=', $FormationParticipant->Formation->id)->get();
        $motif = "";
        if ($sum <= $formationPrix) {
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
        }

        $payement =  new Payement();
        $payement->formation_participant_id = $request->FormationPayement;
        $payement->note = $request->notes;
        $payement->montant = $request->montant;
        $payement->motif = $motif;
        $payement->pay_date = Carbon::now();
        $payement->save();

        $userRandom = Auth::user()->random;

        $identify =  Identify::where('randomUser', '=', $userRandom)->get();
        $payPrint =  Payement::where('id', '=', $payement->id)->get();

        return Pdf::loadView('print.payement-recus', compact('payPrint', 'reste', 'formationPrix', 'identify', 'motif', 'Tranches'))->download('invoice.pdf');
    }
}
