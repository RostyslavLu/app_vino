<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{

    /**
     * Afficher le profil de l'utilisateur.
     */
    public function edit(Request $request): Response
    {
        // chercher les informations du premier cellier connecté à l'utilisateur
        $user = Auth::user();
        $cellar = $user->cellars()->first();

        return Inertia::render('Profile/Edit', [
            'status' => session('status'),
            'cellar' => $cellar,
        ]);
    }

    /**
     * Mettre à jour les informations de l'utilisateur.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Effacer le compte de l'utilisateur.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        //suprimer le cellier
        $cellar = $user->cellars();
        $cellar->delete();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'Votre compte a bien été supprimé!');
    }
}
