<?php
// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Affiche le formulaire de connexion
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Affiche le formulaire d'inscription
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Enregistre un nouvel utilisateur
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Créer un nouvel utilisateur avec le rôle par défaut "user"
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',  // Le rôle par défaut est 'user'
        ]);

        Auth::login($user);

        return redirect()->route('login');
    }

    // Authentifie un utilisateur
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            // Rediriger vers un tableau de bord selon le rôle de l'utilisateur
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');  // Tableau de bord administrateur
            }

            return redirect()->route('dashboard');  // Tableau de bord utilisateur
        }

        throw ValidationException::withMessages([
            'email' => ['Les identifiants fournis sont incorrects.'],
        ]);
    }

    // Déconnecte l'utilisateur
    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
