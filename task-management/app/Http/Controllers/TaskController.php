<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Ajouter cette ligne pour utiliser Auth

class TaskController extends Controller
{
    public function create()
    {
        $users = User::all();
        return view('tasks.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'assigned_to' => $request->assigned_to,
            'user_id' => auth()->id(), // L'utilisateur connecté
        ]);

        return redirect()->route('tasks.index')->with('success', 'Tâche créée avec succès!');
    }

    public function edit(Task $task)
    {
        $users = User::all();
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        return view('tasks.edit', compact('task', 'users'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'assigned_to' => $request->assigned_to,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Tâche mise à jour avec succès!');
    }

    public function destroy(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            return redirect()->route('tasks.index')->with('error', 'Vous n\'avez pas accès à cette tâche.');
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tâche supprimée avec succès!');
    }

    public function toggleCompletion(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            return redirect()->route('tasks.index')->with('error', 'Vous n\'avez pas accès à cette tâche.');
        }

        $task->completed = !$task->completed;
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Statut de la tâche mis à jour!');
    }

    // app/Http/Controllers/TaskController.php

public function index()
{
    // Récupérer les tâches créées par l'utilisateur connecté
    $tasks = auth()->user()->tasks; // L'utilisateur connecté est celui qui a créé les tâches
    $users = User::all(); // On récupère tous les utilisateurs pour pouvoir les assigner à une tâche

    return view('tasks.index', compact('tasks', 'users'));
}


    public function assign(Request $request, Task $task)
    {
        $request->validate([
            'assigned_user_id' => 'required|exists:users,id',
        ]);

        if ($task->user_id !== auth()->id()) {
            return redirect()->route('tasks.index')->with('error', 'Vous n\'avez pas accès à cette tâche.');
        }

        $task->assigned_user_id = $request->assigned_user_id;
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Tâche assignée avec succès!');
    }
}
