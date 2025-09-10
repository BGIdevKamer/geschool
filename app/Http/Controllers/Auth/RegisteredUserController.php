<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Identify;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

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
        $fileLogo = $request->file('logo');
        // $pathLogo = 'assets/identifies/';
        $filenameLogo = uniqid() . '.' . $fileLogo->getClientOriginalExtension();

        $responses=$request->file('logo')->move(public_path('assets/identifies'), $filenameLogo);
        // $nameLogo = storage::disk('public')->put($pathLogo . $filenameLogo, file_get_contents($fileLogo->getRealPath()));


        //enregistrement photo de profil
        $imageUser = $request->file('photo');
        if (!empty($imageUser)) {
            $nameImageUser = storage::disk('public')->put('userFile', $imageUser);
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
        $Identify->logo = $filenameLogo;
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
            'logo' => $nameImageUser,
            'role' => $role,
            'password' => Hash::make($request->password),
            'random' => $token,
            'identifie_id' => $Identify->id,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
