@extends('Admin.layouts.app')

@section('title', 'Tableau de Bord')

@section('content')
<div class="flex min-h-screen bg-gray-50">

    @include('admin.layouts.sidebar')

    <div class="flex-1 p-8 space-y-10">
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Tableau de Bord</h1>
        </div>

        <!-- Statistiques Rapides -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition">
                <h2 class="text-gray-500 text-sm uppercase mb-2">Partenaires</h2>
                <p class="text-2xl font-bold text-gray-800">{{ $partnerCount }}</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition">
                <h2 class="text-gray-500 text-sm uppercase mb-2">Clients</h2>
                <p class="text-2xl font-bold text-gray-800">{{ $clientCount }}</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition">
                <h2 class="text-gray-500 text-sm uppercase mb-2">Annonces</h2>
                <p class="text-2xl font-bold text-gray-800">{{ $annonceCount }}</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition">
                <h2 class="text-gray-500 text-sm uppercase mb-2">Revenus</h2>
                <p class="text-2xl font-bold text-green-600">{{ $totalRevenue }} MAD</p>
            </div>
        </div>

        <!-- Sections Détaillées -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <!-- Performance du logement -->
            <div class="bg-white p-6 rounded-2xl shadow-md">
                <h3 class="text-lg font-semibold mb-4 text-gray-700">Performance du logement</h3>
                <div class="h-40 flex items-center justify-center text-gray-400">Graphique ici</div>
            </div>

            <!-- Calendrier locatif -->
            <div class="bg-white p-6 rounded-2xl shadow-md">
                <h3 class="text-lg font-semibold mb-4 text-gray-700">Calendrier locatif</h3>
                <div class="h-40 flex items-center justify-center text-gray-400">Calendrier ici (Avril 2025)</div>
            </div>

            <!-- Revenus locatifs -->
            <div class="bg-white p-6 rounded-2xl shadow-md">
                <h3 class="text-lg font-semibold mb-4 text-gray-700">Revenus locatifs</h3>
                <div class="h-40 flex items-center justify-center text-gray-400">Bar Chart ici</div>
            </div>

            <!-- Nouvelles annonces -->
            <div class="bg-white p-6 rounded-2xl shadow-md">
                <h3 class="text-lg font-semibold mb-4 text-gray-700">Nouvelles annonces de locations</h3>
                <ul class="divide-y divide-gray-200">
                    @foreach($latestAnnonces as $annonce)
                        <li class="py-2">
                            {{ $annonce->proprietaire->nom }} {{ $annonce->proprietaire->prenom }} - ID {{ $annonce->id }} - {{ $annonce->objet->ville }} - {{ $annonce->objet->prix_journalier }} MAD
                        </li>
                    @endforeach
                </ul>
                <div class="text-xs text-gray-500 mt-2">Résultats 1 à 5 sur 100 | Pagination</div>
            </div>

            <!-- Nouveaux partenaires -->
            <div class="bg-white p-6 rounded-2xl shadow-md">
                <h3 class="text-lg font-semibold mb-4 text-gray-700">Nouveaux Partenaires</h3>
                <ul class="divide-y divide-gray-200">
                    @foreach($newPartners as $partner)
                        <li class="py-2">
                            {{ $partner->nom }} {{ $partner->prenom }} - {{ $partner->annonces_count }} annonces actives
                        </li>
                    @endforeach
                </ul>
                <a href="#" class="block text-sm text-blue-600 mt-2 hover:underline">Voir plus</a>
            </div>

            <!-- Messages -->
            <div class="bg-white p-6 rounded-2xl shadow-md">
                <h3 class="text-lg font-semibold mb-4 text-gray-700">Messages</h3>
                <ul class="divide-y divide-gray-200">
                    @foreach($messages as $message)
                        <li class="py-2">
                            {{ $message->utilisateur->nom }} {{ $message->utilisateur->prenom }} - {{ $message->created_at->format('H:i') }} - {{ $message->contenu }}
                        </li>
                    @endforeach
                </ul>
                <a href="#" class="block text-sm text-blue-600 mt-2 hover:underline">Voir plus</a>
            </div>

            <!-- Commentaires -->
            <div class="bg-white p-6 rounded-2xl shadow-md">
                <h3 class="text-lg font-semibold mb-4 text-gray-700">Commentaires</h3>
                <ul class="divide-y divide-gray-200">
                    @foreach($evaluations as $evaluation)
                        <li class="py-2">
                            {{ $evaluation->objet->nom }} - {{ $evaluation->evaluateur->nom }}: {{ $evaluation->commentaire }}
                        </li>
                    @endforeach
                </ul>
                <a href="#" class="block text-sm text-blue-600 mt-2 hover:underline">Voir plus</a>
            </div>

        </div>
    </div>

</div>
@endsection
