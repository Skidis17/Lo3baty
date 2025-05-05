<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Réservations</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Lato', sans-serif; }
        .statut-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
        }
        .statut-en_attente { background-color: #fef3c7; color: #d97706; }
        .statut-acceptée { background-color: #d1fae5; color: #059669; }
        .statut-archivee { background-color: #f3f4f6; color: #6b7280; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-100" x-data="{ 
    activeStatus: 'all',
    selectedReservation: null,
    getStatusColor(status) {
        return {
            'en_attente': 'statut-en_attente',
            'acceptée': 'statut-acceptée',
            'archivee': 'statut-archivee'
        }[status] || 'bg-gray-100';
    }}" x-cloak>
    
    @include('components.navbar')

    <!-- Sidebar -->
    <div class="fixed left-0 top-0 h-full w-64 bg-white shadow-lg p-4 z-10">
        <h2 class="text-lg font-semibold mb-4">Filtrer par statut</h2>
        <nav class="space-y-2">
            <template x-for="status in ['all', 'en_attente', 'acceptée', 'archivee']" :key="status">
                <button 
                    @click="activeStatus = status"
                    :class="activeStatus === status ? 
                        {'bg-blue-100 text-blue-600': status === 'all',
                         'bg-yellow-100 text-yellow-600': status === 'en_attente',
                         'bg-green-100 text-green-600': status === 'acceptée',
                         'bg-gray-100 text-gray-600': status === 'archivee'} : 
                        'text-gray-600 hover:bg-gray-100'"
                    class="w-full text-left px-4 py-2 rounded-lg transition-colors">
                    <span x-text="{
                        all: 'Toutes les réservations',
                        en_attente: 'En attente',
                        acceptée: 'Acceptée',
                        archivee: 'Archivées'
                    }[status]"></span>
                </button>
            </template>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="ml-64 p-8">
        <h1 class="text-3xl font-bold mb-8">Mes Réservations</h1>

        <div class="space-y-6">
            @forelse($reservations as $reservation)
                @php
                    // Dates avec valeurs absolues
                    $dateDebut = $reservation->date_debut ? Carbon\Carbon::parse($reservation->date_debut) : null;
                    $dateFin = $reservation->date_fin ? Carbon\Carbon::parse($reservation->date_fin) : null;
                    $duree = $dateDebut && $dateFin ? abs($dateDebut->diffInDays($dateFin)) : 0;
                    
                    // Relations avec vérification null
                    $annonce = $reservation->annonce ?? null;
                    $objet = $annonce->objet ?? null;
                    $image = $objet?->images->first() ?? null;
                    
                    // Calculs financiers avec valeurs absolues
                    $prixJournalier = $annonce->prix_journalier ?? 0;
                    $prixTotal = abs($prixJournalier * $duree);

                    // Info partenaire
                    $evaluationDate = $reservation->evaluation_on_partners ? 
                    $reservation->evaluation_on_partners->created_at->translatedFormat('d M Y') : 
                    'Non évalué';    
                    $notePartenaire = $annonce?->utilisateur?->partnerEvaluations?->avg('note') ?? 0;

                @endphp

                <div 
                    class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6 cursor-pointer group relative"
                    x-show="activeStatus === 'all' || activeStatus === '{{ $reservation->statut }}'"
                    @click="selectedReservation = {
                        objet: @js($objet?->nom ?? 'N/A'),
                        image: @js($image?->url ? asset($image->url) : null),
                        dateDebut: @js($dateDebut?->translatedFormat('d M Y') ?? 'N/A'),
                        dateFin: @js($dateFin?->translatedFormat('d M Y') ?? 'N/A'),
                        duree: @js($duree),
                        prixJournalier: @js(number_format(abs($prixJournalier), 0, ',', ' ') . ' DH'),
                        prixTotal: @js(number_format($prixTotal, 0, ',', ' ') . ' DH'),
                        statut: @js($reservation->statut),
                        evaluationDate: @js($reservation->evaluation_date ? Carbon\Carbon::parse($reservation->evaluation_date)->translatedFormat('d M Y') : 'Non évalué'),
                        emailStatus: @js($reservation->is_email ? 'Email dévaluation été reçu' : 'Email dévaluation na pas été encore reçu'),
                        details: @js($objet?->description ?? 'Aucune description disponible'),
                        partenaire: {
                            nom: @js($partenaire->nom ?? 'N/A'),
                            email: @js($partenaire->email ?? 'N/A'),
                            telephone: @js($partenaire->telephone ?? 'N/A'),
                            note: @js(number_format($notePartenaire, 1)),
                            entreprise: @js($annonce->partenaire->nom_entreprise ?? 'N/A')
                        }
                    }"
                >
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <div class="flex items-start gap-4">
                                @if($image)
                                <img src="{{ asset($image->url) }}" 
                                     class="w-24 h-24 object-cover rounded-lg" 
                                     alt="Image du jouet">
                                @endif
                                <div class="flex-1">
                                    <h2 class="text-lg font-semibold">
                                        {{ $objet->nom ?? 'Annonce #'.$reservation->annonce_id }}
                                    </h2>
                                    <div class="text-sm text-gray-600 mt-2">
                                        @if($dateDebut && $dateFin)
                                            {{ $dateDebut->translatedFormat('d M Y') }} - 
                                            {{ $dateFin->translatedFormat('d M Y') }}
                                            <span class="mx-2">•</span>
                                            {{ $duree }} jours
                                        @else
                                            Dates non spécifiées
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex flex-col items-end gap-2">
                            <span class="text-lg font-semibold text-blue-600">
                                {{ number_format($prixTotal, 0, ',', ' ') }} DH
                            </span>
                            <span class="statut-badge {{ [
                                'en_attente' => 'statut-en_attente',
                                'acceptée' => 'statut-acceptée',
                                'archivee' => 'statut-archivee'
                            ][$reservation->statut] ?? 'bg-gray-100' }}">
                                {{ isset($reservation->statut) ? ucfirst(str_replace('_', ' ', $reservation->statut)) : 'Statut inconnu' }}
                            </span>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">
                                @if($reservation->evaluation_date)
                                    Évalué le {{ Carbon\Carbon::parse($reservation->evaluation_date)->translatedFormat('d M Y') }}
                                @else
                                    Non évalué
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 bg-white rounded-lg">
                    <p class="text-gray-500">Aucune réservation trouvée</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Modal Détails -->
    <div x-show="selectedReservation !== null" 
         class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4"
         @click.away="selectedReservation = null">
        <div class="bg-white rounded-xl max-w-2xl w-full p-6">
            <div class="flex justify-between items-start mb-6">
                <h3 class="text-2xl font-bold" x-text="selectedReservation.objet"></h3>
                <button @click="selectedReservation = null" class="text-gray-500 hover:text-gray-700">
                    ✕
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-500">Période de location</p>
                        <p class="font-semibold" x-text="`${selectedReservation.dateDebut} - ${selectedReservation.dateFin}`"></p>
                        <p class="text-sm text-gray-600" x-text="`(${selectedReservation.duree} jours)`"></p>
                    </div>
                    
                    <div>
                        <p class="text-sm text-gray-500">Détails financiers</p>
                        <div class="space-y-2 mt-2">
                            <div class="flex justify-between">
                                <span>Prix journalier:</span>
                                <span x-text="selectedReservation.prixJournalier"></span>
                            </div>
                            <div class="flex justify-between">
                                <span>Total payé:</span>
                                <span class="text-green-600" x-text="selectedReservation.prixTotal"></span>
                            </div>
        
                        </div>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Partenaire</p>
                        <div class="mt-2 space-y-1">
                            <p x-text="`Nom: ${selectedReservation.partenaire.entreprise}`"></p>
                            <p x-text="`Email: ${selectedReservation.partenaire.email}`"></p>
                            <p x-text="`Note: ${selectedReservation.partenaire.note}/5`"></p>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div x-show="selectedReservation.image">
                        <img :src="selectedReservation.image" 
                             class="w-full h-48 object-cover rounded-lg" 
                             alt="Image du jouet">
                    </div>
                    
                    <div>
                        <p class="text-sm text-gray-500">État de la réservation</p>
                        <span class="statut-badge" 
                              :class="getStatusColor(selectedReservation.statut)"
                              x-text="selectedReservation.statut ? selectedReservation.statut.replace('_', ' ') : 'N/A'"></span>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Description</p>
                        <p class="text-gray-600" x-text="selectedReservation.details"></p>
                    </div>
                </div>
            </div>

            <div class="mt-6 pt-4 border-t border-gray-100">
                <div class="flex justify-between text-sm text-gray-600">
                    <span x-text="selectedReservation.emailStatus"></span>
                    <span x-text="`Évaluation: ${selectedReservation.evaluationDate}`"></span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>