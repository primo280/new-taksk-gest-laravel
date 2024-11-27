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

<div class="container mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">Tableau de bord</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    @foreach ($tasks as $task)
    <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition duration-300 ease-in-out">
        <h2 class="text-xl font-semibold text-gray-800 mb-2">Titre: {{ $task->title }}</h2>
        <p class="text-gray-600 mb-4">Description: {{ $task->description }}</p>
        <p class="text-sm text-gray-500 mb-4">
            Statut: 
            <span class="badge {{ $task->completed ? 'bg-success' : 'bg-warning' }}">
                                {{ $task->completed ? 'Terminé' : 'Non terminé' }}
                            </span>
        </p>

        <div class="flex space-x-4">
            <a href="{{ route('tasks.edit', $task) }}" class="inline-block text-white bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-lg">Modifier</a>
            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-block text-white bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg">Supprimer</button>
            </form>
        </div>
    </div>
    @endforeach
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

