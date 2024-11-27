<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        // Récupérer les projets de l'utilisateur connecté
        $projects = Project::where('user_id', auth()->id())->get();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
        ]);

        Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('projects.index')->with('success', 'Projet créé avec succès!');
    }

    public function edit(Project $project)
    {
        $this->authorizeAccess($project);
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $this->authorizeAccess($project);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
            'status' => 'required|in:in_progress,completed',
        ]);

        $project->update($request->all());

        return redirect()->route('projects.index')->with('success', 'Projet mis à jour avec succès!');
    }

    public function destroy(Project $project)
    {
        $this->authorizeAccess($project);

        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Projet supprimé avec succès!');
    }

    private function authorizeAccess(Project $project)
    {
        if ($project->user_id !== auth()->id()) {
            abort(403, 'Accès interdit');
        }
    }
    public function toggleStatus(Project $project)
{
    $project->status = $project->status === 'completed' ? 'in_progress' : 'completed';
    $project->save();

    return redirect()->route('projects.index')->with('success', 'Statut du projet mis à jour.');
}

}
