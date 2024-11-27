<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $users = User::all();
        $tasks = Task::all();
        return view('admin.dashboard', compact('users', 'tasks'));
    }
}
