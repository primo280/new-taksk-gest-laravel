<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<!-- Navbar -->
<nav class="bg-gradient-to-r from-blue-500 to-indigo-600 shadow-lg">
    <div class="container mx-auto p-4 flex justify-between items-center">
        <a class="text-white text-2xl font-semibold" href="{{ url('/') }}"> <i class="fas fa-laptop-house"></i> MonSite</a>
        <div class="space-x-6">
            <!-- Si l'utilisateur est authentifié, afficher les liens -->
            @auth
                <a class="text-white hover:text-gray-200" href="{{ route('dashboard') }}"> <i class="fas fa-tachometer-alt"></i>Tableau de bord</a>
                <a class="text-white hover:text-gray-200" href="{{ route('projects.index') }}"><i class="fas fa-project-diagram"></i>Projets</a>
                <a class="text-white hover:text-gray-200" href="{{ route('tasks.index') }}"><i class="fas fa-tasks"></i> Tâches</a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-white hover:text-gray-200"><i class="fas fa-sign-out-alt"></i>Déconnexion</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
            @endauth
        </div>
    </div>
</nav>

<!-- Tableau de bord -->
<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold text-center mb-6">Tableau de bord</h1>
    
    <!-- Statistiques -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
        <!-- Tâches en cours -->
        <div class="bg-white p-6 rounded-lg shadow-lg flex items-center space-x-4">
            <i class="fas fa-spinner fa-spin text-yellow-500 text-3xl"></i>
            <div>
                <h3 class="text-xl font-semibold mb-2">Tâches en cours</h3>
                <p class="text-lg">{{ $inProgress }}</p>
            </div>
        </div>
        
        <!-- Tâches terminées -->
        <div class="bg-white p-6 rounded-lg shadow-lg flex items-center space-x-4">
            <i class="fas fa-check-circle text-green-500 text-3xl"></i>
            <div>
                <h3 class="text-xl font-semibold mb-2">Tâches terminées</h3>
                <p class="text-lg">{{ $completed }}</p>
            </div>
        </div>

        <!-- Total des tâches -->
        <div class="bg-white p-6 rounded-lg shadow-lg flex items-center space-x-4">
            <i class="fas fa-tasks text-blue-500 text-3xl"></i>
            <div>
                <h3 class="text-xl font-semibold mb-2">Total des tâches</h3>
                <p class="text-lg">{{ $tasks->count() }}</p>
            </div>
        </div>
    </div>

    <!-- Tâches -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($tasks as $task)
        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition duration-300 ease-in-out transform hover:scale-105">
            <h2 class="text-lg font-semibold text-gray-800 mb-2">{{ $task->title }}</h2>
            <p class="text-gray-600 mb-4">{{ $task->description }}</p>
            <p class="text-sm text-gray-500 mb-4">
                Statut: 
                <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full {{ $task->completed ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800' }}">
                    {{ $task->completed ? 'Terminé' : 'Non terminé' }}
                </span>
            </p>

            <div class="flex space-x-4">
                <a href="{{ route('tasks.edit', $task) }}" class="inline-block text-white bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-lg transition duration-300">
                    <i class="fas fa-edit"></i> Modifier
                </a>
                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-block text-white bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg transition duration-300">
                        <i class="fas fa-trash-alt"></i> Supprimer
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Footer -->
<footer class="bg-gradient-to-r from-blue-500 to-indigo-600 py-10 mt-10 text-white">
    <div class="container mx-auto flex justify-between">
        <!-- Section A propos -->
        <div class="w-1/3">
            <h5 class="text-lg font-semibold mb-3">À propos</h5>
            <p>Nous sommes une entreprise dédiée à offrir des services de qualité pour nos clients. Notre mission est de vous fournir les meilleures solutions adaptées à vos besoins.</p>
        </div>
        
        <!-- Section Liens utiles -->
        <div class="w-1/3">
            <h5 class="text-lg font-semibold mb-3">Liens utiles</h5>
            <ul class="space-y-2">
                <li><a href="{{ url('/') }}" class="hover:text-gray-200">Accueil</a></li>
                <li><a href="{{ route('register') }}" class="hover:text-gray-200">Inscription</a></li>
                <li><a href="{{ route('login') }}" class="hover:text-gray-200">Connexion</a></li>
                <li><a href="{{ route('contact') }}" class="hover:text-gray-200">Contact</a></li>
            </ul>
        </div>
        
        <!-- Section Contact -->
        <div class="w-1/3">
            <h5 class="text-lg font-semibold mb-3">Contact</h5>
            <ul>
                <li><strong>Adresse :</strong> 123, Rue de l'Entreprise, Ville, Pays</li>
                <li><strong>Téléphone :</strong> +123 456 7890</li>
                <li><strong>Email :</strong> contact@monsite.com</li>
            </ul>
        </div>
    </div>
    <hr class="border-gray-400 my-5">
    <div class="text-center">
        <p>&copy; 2024 MonSite. Tous droits réservés.</p>
    </div>
</footer>

<!-- Bootstrap 5 JS (JavaScript Bundle with Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Animation (Animate.css) -->
<link href="https://cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css" rel="stylesheet">

</body>
</html>
