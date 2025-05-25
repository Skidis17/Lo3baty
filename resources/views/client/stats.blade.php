<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Statistiques Client</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-black-50 to-black-200 min-h-screen">

@include('components.sideBar')

<div class="max-w-6xl mx-auto mt-16 px-4">
    <div class="mb-10">
        <h1 class="text-4xl font-bold text-black-800 mb-1">Statistiques de <span class="text-[#e63a28]">{{ $clientName }} {{ $clientPrenom }}</span></h1>
        <p class="text-sm text-black-500">Bienvenue sur votre tableau de bord personnalisé</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-12">
        @php
            $cards = [
                ['title' => 'Clients utilisant la plateforme', 'value' => $totalClients],
                ['title' => 'Nombre de Réservations', 'value' => $totalReservations],
                ['title' => 'Réclamations', 'value' => $totalReclamations],
                ['title' => 'Client depuis', 'value' => $startDate],
                ['title' => 'Note Moyenne', 'value' => $averageNote],
            ];
        @endphp

        @foreach($cards as $card)
            <div class="bg-white p-6 rounded-xl hover:shadow-xl transition duration-100 transform hover:scale-[1.01] backdrop-blur-md border border-black-300">
                <h2 class="text-black-600 text-sm font-medium mb-2 tracking-wide uppercase">{{ $card['title'] }}</h2>
                <p class="text-3xl font-bold text-[#e63a28]">{{ $card['value'] }}</p>
            </div>
        @endforeach
    </div>

    <!-- Commentaires -->
<div class="mb-12">
    <h2 class="text-2xl font-bold text-black-800 mb-6">Commentaires reçus</h2>

    @if($evaluations->isEmpty())
        <div class="bg-white p-6 rounded-xl border border-black-300 text-black-500">
            Aucun commentaire pour le moment.
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($evaluations as $evaluation)
                <div class="bg-white p-6 rounded-xl hover:shadow-xl transition duration-100 transform hover:scale-[1.01] backdrop-blur-md border border-black-300">
                    <p class="text-black-700 italic mb-3">"{{ $evaluation->commentaire }}"</p>
                    <p class="text-sm text-black-500">Note : <span class="font-semibold text-[#e63a28]">{{ $evaluation->note }}/5</span></p>
                    <p class="text-xs text-black-400">le {{ \Carbon\Carbon::parse($evaluation->created_at)->format('d/m/Y') }}</p>
                </div>
            @endforeach
        </div>
    @endif
</div>

</body>
</html>
