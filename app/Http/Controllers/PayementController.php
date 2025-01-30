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
use FontLib\Table\Type\name;
use Illuminate\Support\Facades\Storage;

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
        $reste =  $formationPrix - $sum; // a commanter
        $Tranches = Tranche::where('formation_id', '=', $FormationParticipant->Formation->id)->get();
        if (count($Tranches) == 0) {
            return redirect()->route('Payement.index')->with('err', 'veiller d\'abord renseigner les tranche de cette fromation');
        }
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
        } else {
            return redirect()->route('Payement.index')->with('err', 'la scolariter de ce participant est solder');
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

        $identify =  Identify::where('randomUser', '=', $userRandom)->get();
        $payPrint =  Payement::where('id', '=', $id)->get();
        $payement =  Payement::find($id);


        $prix = $payement->FormationParticipant->Formation->prix;

        $payement =  Payement::where('formation_participant_id', $payement->formation_participant_id)->sum('montant');
        $reste = $prix - $payement;

        // Créer le dossier "PayementRecus" dans le système de stockage
        Storage::disk('public')->makeDirectory('PayementRecus');

        $filename = 'PayementRecus/' . $id . '.pdf';

        // Générer le PDF en utilisant le chemin absolu pour l'image
        Pdf::loadView('print.payement-recus', compact('payPrint', 'reste', 'identify', 'prix'))
            ->setPaper(([0, 0, 400, 500]), 'landscape')
            ->save($fileroute = storage_path('app/public/' . $filename));

        // Retourner le fichier PDF
        return response()->file($fileroute);
    }
}
