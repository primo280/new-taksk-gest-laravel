@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">Statistiques</h1>
    <div class="grid grid-cols-2 gap-4">
        <div class="p-4 bg-green-100 rounded">
            <h2 class="text-lg font-semibold">Tâches en cours</h2>
            <p class="text-3xl">{{ $inProgress }}</p>
        </div>
        <div class="p-4 bg-blue-100 rounded">
            <h2 class="text-lg font-semibold">Tâches terminées</h2>
            <p class="text-3xl">{{ $completed }}</p>
        </div>
    </div>
</div>
@endsection
