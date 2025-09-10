<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Years;
use App\Models\Salle;
use App\Models\Evaluation;
use App\Models\Identify;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class GeneralController extends Controller
{
    public function index()
    {
        $years = Years::where('randomUser', Auth::user()->random)->get();
        $Salles = Salle::where('randomUser', Auth::user()->random)->get();
        $Evaluations = Evaluation::where('randomUser', Auth::user()->random)->get();
        return view('General', compact('years', 'Salles', 'Evaluations'));
    }
    public function Years(Request $request)
    {
        $request->validate([
            'reference' => 'nullable',
            'number' => 'required|integer',
        ]);

        if (empty($request->reference)) {
            $annee = date('Y');
        } else {
            $annee = $request->reference;
        }
        $annee_now = $annee;
        $annee_next = 0;
        for ($i = 1; $i <= $request->number; $i++) {
            $annee_next = $annee_now + 1;
            $Years = $annee_now . '-' . $annee_next;
            $annee_now = $annee_next;

            $verification = Years::where('Years', '=', $Years)
                ->where('randomUser', Auth::user()->random)
                ->exists();

            if (!$verification) {
                $years = new Years();
                $years->Years = $Years;
                $years->randomUser = Auth::user()->random;
                $years->save();
            }
        }
        return redirect()->route('General.index')->with('success', 'Annéés Scolaire cree avec success');
    }
    public function ActiveYears(Request $request)
    {
        $request->validate([
            'activeYears' => 'required'
        ]);

        if (Years::where('active', 1)
            ->where('Years', $request->activeYears)
            ->where('randomUser', Auth::user()->random)
            ->exists()
        ) {
            return redirect()->route('General.index')->with('success', 'Cette annéé scolaire est deja activer par defaut');
        }

        $verification = Years::where('active', 1)
            ->where('randomUser', Auth::user()->random)
            ->exists();

        if ($verification) {
            Years::where('randomUser', Auth::user()->random)->update([
                'active' => 0,
            ]);
        }

        Years::where('Years', $request->activeYears)
            ->where('randomUser', Auth::user()->random)->update([
                'active' => 1,
            ]);

        return redirect()->route('General.index')->with('success', 'Annéés Scolaire Activer avec success');
    }
    public function indexIdentite()
    {
        $Identify = Identify::where('id', Auth::user()->identifie_id)->first();
        //
        $Personnelles =  User::where('random', Auth::user()->random)
            ->where('id', '!=', Auth::user()->id)
            ->get();

        return view('Identite', compact('Identify', 'Personnelles'));
    }
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', Rules\Password::defaults()],
            'telephone' => ['required', 'integer'],
            'photo' => ['required'],
            'role' => ['required'],
        ]);

        $imageUser = $request->file('photo');
        if (!empty($imageUser)) {
            $nameImageUser = storage::disk('public')->put('userFile', $imageUser);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'logo' => $nameImageUser,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'random' => Auth::user()->random,
            'identifie_id' => Auth::user()->identifie_id,
        ]);

        return redirect()->route('index.Identite')->with('success', 'Personnel ajouter avec succes !');
    }
    public function update(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'rs' => 'required',
            'ville' => 'required',
            'adress' => 'required',
            'bp' => 'required',
            'telephone' => 'required|integer',
            'type' => 'required|integer',
            'logo' => 'nullable',
            'id' => 'required',
        ]);

        if (empty($request->logo)) {
            $filenameLogo = Identify::where('id', $request->id)->value('logo');
        } else {
            $Path =  Identify::where('id', $request->id)->value('logo');
            $filePath = public_path('assets/identifies/' . $Path);
            // Storage::delete($filePath);

            if (file_exists($filePath)) {
                unlink($filePath);
            } 

            //add new file logo 
            // $fileLogo = $request->file('logo');
            // $pathLogo = 'assets/identifies/';
            // $filenameLogo = uniqid() . '.' . $fileLogo->getClientOriginalExtension();
            // $nameLogo = storage::disk('public')->put($pathLogo . $filenameLogo, file_get_contents($fileLogo->getRealPath()));

            $fileLogo = $request->file('logo');
            // $pathLogo = 'assets/identifies/';
            $filenameLogo = uniqid() . '.' . $fileLogo->getClientOriginalExtension();

            $request->file('logo')->move(public_path('assets/identifies'), $filenameLogo);
        }

        Identify::where('id', $request->id)->update([
            'email' => $request->email,
            'raisonSocial' => $request->rs,
            'ville' => $request->ville,
            'adress' => $request->adress,
            'Bp' => $request->bp,
            'telephone' => $request->telephone,
            'type' => $request->type,
            'logo' => $filenameLogo,
        ]);

        return redirect()->route('index.Identite')->with('success', 'Identité modifier avec success !');
    }
    public function deletePersonnel($id)
    {
        $User = User::where('id', $id)->where('id', '!=', Auth::user()->id)->first();
        if ($User->delete()) {
            return redirect()->route('index.Identite')->with('success', 'Supression du personnel reussite !');
        }
    }
    public function updatePersonnel(Request $request)
    {
        $request->validate([
            'nameUpdate' => 'required',
            'idUpdate' => 'required|integer',
            'emailUpdate' => 'required|email',
            'roleUpdate' => 'nullable',
            'telephoneUpdate' => 'required|integer',
            'passwordUpdate' => ['nullable', Rules\Password::defaults()],
        ]);

        if (empty($request->passwordUpdate)) {
            $password = User::where('id', $request->idUpdate)->value('password');
        } else {
            $password = Hash::make($request->password);
        }

        if (empty($request->roleUpdate)) {
            $role = User::where('id', $request->idUpdate)->value('role');
        } else {
            $role = $request->roleUpdate;
        }

        User::where('id', $request->idUpdate)->update([
            'name' => $request->nameUpdate,
            'email' => $request->emailUpdate,
            'telephone' => $request->telephoneUpdate,
            'password' => $password,
            'role' => $role,
        ]);

        return redirect()->route('index.Identite')->with('success', 'Modification de l\'utilisateur avec succes !');
    }
}
