<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
 

public function index()
{
    $user = Auth::user();
    
    if ($user->role === 'partenaire') {
        return view('partenaire.home');
    }
    
    return view('client.home');
}


public function partenaireHome()
{
    if (Auth::user()->role !== 'partenaire') {
        return redirect()->route('client.home');
    }
    return view('partenaire.home');
}

public function clientHome()
{
    return view('client.home');
}
}