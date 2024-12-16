<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Affiche le formulaire d'inscription.
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Gère l'inscription.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);


        User::create([
            'name' => $request->name,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Mail::to($user->email)->send(new WelcomeEmail($user));


        return redirect()->route('login')->with('success', 'Inscription réussie. Veuillez vous connecter.');

    }

    /**
     * Affiche le formulaire de connexion.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Gère la connexion.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->intended('/')->with('success', 'Connexion réussie.');
        }

        return back()->withErrors(['email' => 'Identifiants incorrects.']);
    }

    /**
     * Gère la déconnexion.
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Vous êtes déconnecté.');
    }
}
