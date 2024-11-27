@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">Tableau de bord Administrateur</h1>
    <h2 class="text-xl mb-4">Liste des Utilisateurs</h2>
    <ul class="mb-6">
        @foreach ($users as $user)
        <li>{{ $user->name }} - {{ $user->email }}</li>
        @endforeach
    </ul>
    <h2 class="text-xl mb-4">Liste des Tâches</h2>
    <ul>
        @foreach ($tasks as $task)
        <li>{{ $task->title }} - {{ $task->status }}</li>
        @endforeach
    </ul>
</div>
@endsection
