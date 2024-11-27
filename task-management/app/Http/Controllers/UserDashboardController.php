<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->tasks()->get(); // Si vous avez configuré une relation User-Task
        return view('dashboard', compact('tasks'));
    }
    public function stats()
{
    $tasks = auth()->user()->tasks;
    $inProgress = $tasks->where('status', 'in_progress')->count();
    $completed = $tasks->where('status', 'completed')->count();

    return view('dashboard.stats', compact('inProgress', 'completed'));
}

}
