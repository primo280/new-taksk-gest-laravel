<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
{
    // Récupérer toutes les tâches de l'utilisateur connecté
    $tasks = auth()->user()->tasks()->get();

    // Calculer les statistiques sur la base du champ 'completed'
    $inProgress = $tasks->where('completed', false)->count(); // Tâches en cours (non terminées)
    $completed = $tasks->where('completed', true)->count(); // Tâches terminées

    // Passer les données à la vue
    return view('dashboard', compact('tasks', 'inProgress', 'completed'));
}



}
