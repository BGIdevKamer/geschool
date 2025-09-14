<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Identify;
use App\Models\PlantUser;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', Rules\Password::defaults()],
            'telephone' => ['required', 'integer'],
            'emailE' => ['required'],
            'ville' => ['required'],
            'Rs' => ['required'],
            'adress' => ['required'],
            'Bp' => ['required'],
            'phone' => ['required'],
            'type' => ['required'],
            'logo' => ['required'],
        ]);

        // Enregistrement du logo
        if ($request->hasFile('logo')) {
            $fileLogo = $request->file('logo');
            $filenameLogo = uniqid() . '.' . $fileLogo->getClientOriginalExtension();

            // Sauvegarde sur le disque public (bucket Laravel Cloud)
            $pathLogo = $fileLogo->storeAs('userFile', $filenameLogo, 'public');
        }

        // Enregistrement photo de profil
        if ($request->hasFile('photo')) {
            $imageUser = $request->file('photo');

            // Ici Laravel génère automatiquement un nom unique
            $pathImageUser = $imageUser->store('userFile', 'public');
       }

        function generateToken()
        {
            $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $token = str_shuffle($chars);
            return substr($token, 0, 15) . substr($token, 26, 2);
        }

        $token = generateToken();


        $Identify = new Identify();
        $Identify->email = $request->emailE;
        $Identify->raisonSocial = $request->Rs;
        $Identify->logo = $pathLogo;
        $Identify->ville = $request->ville;
        $Identify->adress = $request->adress;
        $Identify->Bp = $request->Bp;
        $Identify->randomUser = $token;
        $Identify->type = $request->type;
        $Identify->telephone = $request->phone;
        $Identify->save();
       

        if ($request->type == "4") {
            $role = "OnlineAdmin";
        } else {
            $role = "Admin";
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'logo' => $pathImageUser,
            'role' => $role,
            'password' => Hash::make($request->password),
            'random' => $token,
            'identifie_id' => $Identify->id,
        ]);

        // CREATION DU PLANT UTILISATEUR

        $startDate = Carbon::today();
        $endDate = Carbon::today()->addDays(30);

        $PlantUser = new PlantUser();
        $PlantUser->user_id = $user->id;
        $PlantUser->plant_id = 1;
        $PlantUser->date_debut = $startDate;
        $PlantUser->date_fin = $endDate;
        $PlantUser->statue = 1;
        $PlantUser->save();


        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
