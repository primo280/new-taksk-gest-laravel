
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
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Inscription</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Connexion</a>
                </li>
               
            </ul>
        </div>
    </div>
</nav>
<x-guest-layout>
    <div class="max-w-md mx-auto mt-10 bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-6">Connexion</h1>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                       class="w-full border rounded p-2 @error('email') border-red-500 @enderror" required>
                @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Mot de passe -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Mot de passe</label>
                <input id="password" type="password" name="password"
                       class="w-full border rounded p-2 @error('password') border-red-500 @enderror" required>
                @error('password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Checkbox : Se souvenir de moi -->
            <div class="mb-4 flex items-center">
                <input id="remember_me" type="checkbox" name="remember"
                       class="mr-2">
                <label for="remember_me" class="text-gray-700">Se souvenir de moi</label>
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded">Se connecter</button>
        </form>

        <!-- Lien mot de passe oublié -->
        <div class="mt-4 text-center">
        <a href="{{ route('password.request') }}" class="text-blue-500 hover:underline">
    Mot de passe oublié ?
</a>

        </div>
    </div>
</x-guest-layout>



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
