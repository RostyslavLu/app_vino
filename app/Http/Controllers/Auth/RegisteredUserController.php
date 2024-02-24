<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Cellars;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'cellar_name' => 'max:50',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // il faut vérifier si le cellier à un nom
        $cellarName = $request->cellar_name ?? '';
        if($request->cellar_name == ''){
            $cellarName = 'le cellier chez '.$user->name;
        }



        Cellars::create([
            'name' => $cellarName,
            'description' => 'Pas de description fournie.', // Valeur non vide par défaut
            'user_id' => $user->id,
        ]);
        //TODO: est-ce qu'on veut que l'utilisateur qui vient de
        //s'enregistrer soit logout? 
        Auth::login($user);


/*      Auth::logout($user);

        return redirect()->route('login'); */

        return redirect()->route('dashboard');
    }
}
