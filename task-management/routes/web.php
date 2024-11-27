<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\HomeController;  // Importer le contrôleur
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
// routes/web.php

// routes/web.php

use App\Http\Controllers\TaskController;

// Récupérer les tâches d'un utilisateur connecté
Route::middleware('auth')->group(function () {
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');  // Afficher les tâches
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');  // Formulaire de création
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');  // Enregistrer la nouvelle tâche
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');  // Formulaire d'édition
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');  // Mettre à jour la tâche
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');  // Supprimer une tâche
    Route::patch('/tasks/{task}/toggle', [TaskController::class, 'toggleCompletion'])->name('tasks.toggleCompletion');  // Marquer la tâche comme terminée
    Route::patch('/tasks/{task}/assign', [TaskController::class, 'assign'])->name('tasks.assign');

});

// Authentification


// Affichage du formulaire de connexion
Route::get('/connexion', [AuthController::class, 'showLoginForm'])->name('login');

// Affichage du formulaire d'inscription
Route::get('/', [AuthController::class, 'showRegistrationForm'])->name('register');

// Enregistrer un nouvel utilisateur
Route::post('/', [AuthController::class, 'register'])->name('register.submit');

// Authentifier un utilisateur
Route::post('/connexion', [AuthController::class, 'login'])->name('login.submit');

// Déconnexion de l'utilisateur
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Tableau de bord
Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

// Gestion des projets


Route::resource('projects', ProjectController::class)->middleware('auth');
Route::patch('/projects/{project}/toggle-status', [ProjectController::class, 'toggleStatus'])->name('projects.toggleStatus');

// Gestion des tâches
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
