<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Afficher la page d'accueil.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('home');  // Retourne la vue home.blade.php
    }
}
