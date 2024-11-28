<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le projet</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- FontAwesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">

    <!-- DataTables JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

    <!-- Custom CSS for Animations -->
    <style>
        .btn-custom {
            transition: all 0.3s ease-in-out;
        }

        .btn-custom:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .input-custom {
            transition: border 0.3s ease;
        }

        .input-custom:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 5px rgba(59, 130, 246, 0.5);
        }

        .form-container {
            width: 100%;
            max-width: 500px;
            padding: 2rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
        }

        .form-group {
            position: relative;
        }
    </style>
</head>

<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-blue-500 shadow-sm">
        <div class="container">
            <a class="navbar-brand text-white" href="{{ url('/') }}">
                <i class="fas fa-laptop-house"></i> MonSite
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i> Tableau de bord
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('projects.index') }}">
                            <i class="fas fa-project-diagram"></i> Projets
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('tasks.index') }}">
                            <i class="fas fa-tasks"></i> Tâches
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> Déconnexion
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-6">Mes Projets</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('projects.create') }}" class="btn btn-primary mb-3 hover:bg-blue-600 transition duration-200"><i class="bi bi-plus-circle"></i> Créer un projet</a>

        <!-- Table -->
        <table id="projectsTable" class="table table-striped table-bordered" data-table="true">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Date limite</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr class="transition duration-300 ease-in-out transform hover:scale-105">
                        <td>{{ $project->title }}</td>
                        <td>{{ $project->description }}</td>
                        <td>{{ $project->deadline }}</td>
                        <td>
                            <span class="badge {{ $project->status === 'completed' ? 'bg-green-500' : 'bg-yellow-500' }}">
                                {{ $project->status === 'completed' ? 'Terminé' : 'En cours' }}
                            </span>
                        </td>
                        <td class="table-actions flex items-center space-x-2">
                            <a href="{{ route('projects.edit', $project) }}" class="btn btn-warning btn-sm text-white hover:bg-yellow-600 transition duration-200">
                                <i class="bi bi-pencil-square"></i> Modifier
                            </a>

                            <form action="{{ route('projects.destroy', $project) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm text-white hover:bg-red-600 transition duration-200">
                                    <i class="bi bi-trash"></i> Supprimer
                                </button>
                            </form>

                            <form action="{{ route('projects.toggleStatus', $project) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-info btn-sm text-white hover:bg-blue-600 transition duration-200">
                                    <i class="bi bi-toggle-on"></i> 
                                    {{ $project->status === 'completed' ? 'Marquer en cours' : 'Terminer le projet' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-500 py-5 mt-5">
        <div class="container">
            <div class="row text-white">
                <div class="col-md-4">
                    <h5>À propos</h5>
                    <p>Nous sommes une entreprise dédiée à offrir des services de qualité pour nos clients. Notre mission est de vous fournir les meilleures solutions adaptées à vos besoins.</p>
                </div>
                <div class="col-md-4">
                    <h5>Liens utiles</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ url('/') }}" class="text-white">Accueil</a></li>
                        <li><a href="{{ route('register') }}" class="text-white">Inscription</a></li>
                        <li><a href="{{ route('login') }}" class="text-white">Connexion</a></li>
                        <li><a href="{{ route('contact') }}" class="text-white">Contact</a></li>
                        <li><a href="{{ route('projects.index') }}" class="text-white">Projets</a></li>
                        <li><a href="{{ route('tasks.index') }}" class="text-white">Tâches</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contact</h5>
                    <ul class="list-unstyled">
                        <li><strong>Adresse :</strong> 123, Rue de l'Entreprise, Ville, Pays</li>
                        <li><strong>Téléphone :</strong> +123 456 7890</li>
                        <li><strong>Email :</strong> contact@monsite.com</li>
                    </ul>
                    <div class="footer-icons mt-3">
                        <a href="#" class="mr-3 text-white"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="mr-3 text-white"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center text-white">
                <p>&copy; 2024 MonSite. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <!-- Initialize DataTable -->
    <script>
        $(document).ready(function() {
            $('#projectsTable').DataTable();
        });
    </script>
</body>

</html>
