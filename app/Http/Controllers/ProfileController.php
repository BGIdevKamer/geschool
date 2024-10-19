<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function updateInfo(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'rs' => ['required', 'string', 'max:255'],
            'ville' => ['required', 'string', 'max:255'],
            'numero' => ['required', 'max:9'],
            'logo' => ['required'],
            'adress' => ['required', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
        ]);

        $name = storage::disk('public')->put('profilImg', $request->logo);

        User::where('id', Auth::user()->id)->update([
            'name' => $request->name,
            'raisonSocial' => $request->rs,
            'email' => $request->email,
            'ville' => $request->ville,
            'telephone' => $request->numero,
            'adress' => $request->adress,
            'logo' => $name,
        ]);

        return Redirect::to('/profil');
    }
}
