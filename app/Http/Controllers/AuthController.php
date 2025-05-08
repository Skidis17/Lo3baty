<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
  public function showRegisterForm()
  {
    return view('auth.register');
  }

  public function register(Request $request)
  {
    $request->validate([
      'nom' => 'required|string|max:255',
      'prenom' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:utilisateur',
      'mot_de_passe' => 'required|string|min:8|confirmed',
      'image_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $imagePath = null;
    if ($request->hasFile('image_profil')) {
      $imagePath = $request->file('image_profil')->store('profile_images', 'public');
    }

    $user = Utilisateur::create([
      'nom' => $request->nom,
      'prenom' => $request->prenom,
      'email' => $request->email,
      'mot_de_passe' => Hash::make($request->mot_de_passe),
      'role' => 'client',
      'image_profil' => $imagePath,
    ]);

    Auth::login($user);

    return redirect()->route('home')->with('success', 'Inscription réussie!');
  }

  public function showLoginForm()
  {
    return view('auth.login');
  }

  public function login(Request $request)
  {
    $credentials = $request->validate([
      'email' => 'required|email',
      'mot_de_passe' => 'required',
    ]);

    if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['mot_de_passe']])) {
      $user = Auth::user();
      if (!$user->is_active) {
        Auth::logout();
        return back()->withErrors([
          'email' => 'Votre compte est désactivé. Veuillez contacter l\'administrateur.',
        ]);
      }

      $request->session()->regenerate();
      return redirect()->intended('/client/acceuil');
    }

    return back()->withErrors([
      'email' => 'Les identifiants fournis ne correspondent pas à nos enregistrements.',
    ]);
  }

  public function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
  }
}
