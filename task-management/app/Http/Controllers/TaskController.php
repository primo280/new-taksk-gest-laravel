<?php
// app/Http/Controllers/TaskController.php
namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create()
    {
        // Passer la liste des utilisateurs au formulaire
        $users = User::all();
        return view('tasks.create', compact('users'));
    }

    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assigned_to' => 'nullable|exists:users,id', // Assurez-vous que l'ID de l'utilisateur existe
        ]);

        // Créer la tâche
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'assigned_to' => $request->assigned_to,
            'user_id' => auth()->id(), // L'utilisateur qui crée la tâche
        ]);

        return redirect()->route('tasks.index')->with('success', 'Tâche créée avec succès!');
    }

    public function edit(Task $task)
    {
        $users = User::all();
        return view('tasks.edit', compact('task', 'users'));
    }

    public function update(Request $request, Task $task)
    {
        // Validation des données
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assigned_to' => 'nullable|exists:users,id', // Assurez-vous que l'ID de l'utilisateur existe
        ]);

        // Mise à jour de la tâche
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'assigned_to' => $request->assigned_to,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Tâche mise à jour avec succès!');
    }// Supprimer une tâche
    public function destroy(Task $task)
    {
        // Vérifier si la tâche appartient à l'utilisateur connecté
        if ($task->user_id !== auth()->id()) {
            return redirect()->route('tasks.index')->with('error', 'Vous n\'avez pas accès à cette tâche.');
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tâche supprimée avec succès!');
    }
      // Marquer une tâche comme terminée ou non terminée
      public function toggleCompletion(Task $task)
      {
          // Vérifier si la tâche appartient à l'utilisateur connecté
          if ($task->user_id !== auth()->id()) {
              return redirect()->route('tasks.index')->with('error', 'Vous n\'avez pas accès à cette tâche.');
          }
  
          $task->completed = !$task->completed;  // Inverse le statut de la tâche
          $task->save();
  
          return redirect()->route('tasks.index')->with('success', 'Statut de la tâche mis à jour!');
      }
    // app/Http/Controllers/TaskController.php
  // app/Http/Controllers/TaskController.php
public function index()
{
    $tasks = Task::with('assignedUser')->get(); // Inclure l'utilisateur assigné
    $users = User::all(); // Tous les utilisateurs pour le formulaire d'assignation
    return view('tasks.index', compact('tasks', 'users'));
}


    

public function assign(Request $request, Task $task)
{
    // Validation de l'utilisateur assigné
    $request->validate([
        'assigned_user_id' => 'required|exists:users,id', // Vérifie que l'utilisateur existe
    ]);

    // Vérifier que la tâche appartient à l'utilisateur connecté (facultatif)
    if ($task->user_id !== auth()->id()) {
        return redirect()->route('tasks.index')->with('error', 'Vous n\'avez pas accès à cette tâche.');
    }

    // Mettre à jour l'utilisateur assigné
    $task->assigned_user_id = $request->assigned_user_id;
    $task->save();

    return redirect()->route('tasks.index')->with('success', 'Tâche assignée avec succès!');
}

}
