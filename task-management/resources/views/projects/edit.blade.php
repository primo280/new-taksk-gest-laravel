<!-- Bootstrap 5 CSS -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">MonSite</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                
                <!-- Si l'utilisateur est authentifié, afficher les liens vers le tableau de bord et gestion de projet -->
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Tableau de bord</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('projects.index') }}">Projets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tasks.index') }}">Tâches</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Déconnexion</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <h1>Modifier le projet</h1>

    <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="w-50">
        <h1 class="text-center mb-4">Modifier le projet</h1>

        <form action="{{ route('projects.update', $project) }}" method="POST" class="shadow p-4 rounded">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Titre</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $project->title }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description">{{ $project->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="deadline" class="form-label">Date limite</label>
                <input type="date" class="form-control" id="deadline" name="deadline" value="{{ $project->deadline }}" required>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Statut</label>
                <select id="status" name="status" class="form-select">
                    <option value="in_progress" {{ $project->status === 'in_progress' ? 'selected' : '' }}>En cours</option>
                    <option value="completed" {{ $project->status === 'completed' ? 'selected' : '' }}>Terminé</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">Mettre à jour</button>
        </form>
    </div>
</div>

<!-- Footer -->
<footer class="bg-light py-5 mt-5">
    <div class="container">
        <div class="row">
            <!-- Section A propos -->
            <div class="col-md-4">
                <h5>À propos</h5>
                <p>
                    Nous sommes une entreprise dédiée à offrir des services de qualité pour nos clients. Notre mission est de vous fournir les meilleures solutions adaptées à vos besoins.
                </p>
            </div>
            <!-- Section Liens utiles -->
            <div class="col-md-4">
                <h5>Liens utiles</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ url('/') }}" class="text-dark">Accueil</a></li>
                    <li><a href="{{ route('register') }}" class="text-dark">Inscription</a></li>
                    <li><a href="{{ route('login') }}" class="text-dark">Connexion</a></li>
                    <li><a href="{{ route('contact') }}" class="text-dark">Contact</a></li>
                    <li><a href="{{ route('projects.index') }}" class="text-dark">Projets</a></li>
                    <li><a href="{{ route('tasks.index') }}" class="text-dark">Tâches</a></li>
                </ul>
            </div>
            <!-- Section Contact -->
            <div class="col-md-4">
                <h5>Contact</h5>
                <ul class="list-unstyled">
                    <li><strong>Adresse :</strong> 123, Rue de l'Entreprise, Ville, Pays</li>
                    <li><strong>Téléphone :</strong> +123 456 7890</li>
                    <li><strong>Email :</strong> contact@monsite.com</li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="text-center">
            <p>&copy; 2024 MonSite. Tous droits réservés.</p>
        </div>
    </div>
</footer>

<!-- Bootstrap 5 JS (JavaScript Bundle with Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>
</html>


