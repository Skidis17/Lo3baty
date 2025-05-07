<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/fr.js"></script>
    
    <!-- Custom CSS -->
    <link href="{{ asset('css/annonce-details.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body class="bg-gray-50">
    @include('components.navbar')
    <div class="min-h-screen">
@section('content')
<div class="container mx-auto px-4 py-8">
    <nav class="flex mb-6" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ url('/') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                    <i class="fas fa-home mr-2"></i> Accueil
                </a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Détails de l'annonce</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Annonce Details -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4">
            <!-- Image Gallery -->
            <div class="md:col-span-1">
                @if($annonce->objet->images->isNotEmpty())
                    <div class="swiper-container relative">
                        <div class="swiper-wrapper">
                            @foreach($annonce->objet->images as $image)
                                <div class="swiper-slide">
                                    <img src="{{ asset($image->url) }}" alt="{{ $annonce->objet->nom }}" 
                                         class="w-100 h-96 object-cover rounded-lg">
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                @else
                    <div class="bg-gray-200 h-96 flex items-center justify-center rounded-lg">
                        <span class="text-gray-500">
                            <i class="fas fa-image fa-2x mb-2"></i><br>
                            Aucune image disponible
                        </span>
                    </div>
                @endif
            </div>

            <!-- Details Section -->
            <div class="md:col-span-1 p-4">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $annonce->objet->nom }}</h1>
                
                <!-- Partner Info -->
                <div class="flex items-center mb-4">
                    <div class="flex-shrink-0">
                        <img class="w-10 h-10 rounded-full object-cover" 
                             src="{{ $annonce->proprietaire->image_profil }}" 
                             alt="{{ $annonce->proprietaire->surnom }}">
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-900">
                            Proposé par {{ $annonce->proprietaire->surnom }}
                        </p>
                        <div class="flex items-center">
                            @php
                                $averageRating = $evaluationsPartner->avg('note');
                                $fullStars = floor($averageRating);
                                $hasHalfStar = $averageRating - $fullStars >= 0.5;
                            @endphp
                            
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $fullStars)
                                    <i class="fas fa-star text-yellow-400"></i>
                                @elseif($i == $fullStars + 1 && $hasHalfStar)
                                    <i class="fas fa-star-half-alt text-yellow-400"></i>
                                @else
                                    <i class="far fa-star text-gray-300"></i>
                                @endif
                            @endfor
                            <span class="text-xs text-gray-600 ml-1">({{ $evaluationsPartner->count() }} avis)</span>
                        </div>
                    </div>
                </div>

                <!-- Price and Status -->
                <div class="flex justify-between items-center mb-4">
                    <span class="text-2xl font-bold text-gray-900">
                        {{ number_format($annonce->prix_journalier, 2) }} MAD/jour
                    </span>
                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                        <i class="fas fa-circle mr-1"></i> {{ ucfirst($annonce->statut) }}
                    </span>
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">
                        <i class="fas fa-align-left mr-2"></i>Description
                    </h3>
                    <p class="text-gray-600">{{ $annonce->objet->description }}</p>
                </div>

                <!-- Details Grid -->
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <p class="text-sm text-gray-500">
                            <i class="fas fa-city mr-1"></i> Ville
                        </p>
                        <p class="font-medium">{{ $annonce->objet->ville }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">
                            <i class="fas fa-battery-three-quarters mr-1"></i> État
                        </p>
                        <p class="font-medium">{{ $annonce->objet->etat }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">
                            <i class="far fa-calendar-alt mr-1"></i> Date de publication
                        </p>
                        <p class="font-medium">
                            {{ \Carbon\Carbon::parse($annonce->date_publication)->format('d/m/Y') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">
                            <i class="fas fa-calendar-check mr-1"></i> Disponibilité
                        </p>
                        <p class="font-medium">
                            {{ \Carbon\Carbon::parse($annonce->date_debut)->format('d/m/Y') }} - 
                            {{ \Carbon\Carbon::parse($annonce->date_fin)->format('d/m/Y') }}
                        </p>
                    </div>
                </div>

                <!-- Reservation Section -->
                <div class="reservation-section bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        <i class="far fa-calendar-plus mr-2"></i>Réserver cet objet
                    </h3>
                    
                    <!-- Calendar -->
                    <div class="mb-6">
                        <div id="calendar" class="border rounded-lg p-4 bg-white"></div>
                    </div>

                    <!-- Form -->
                    <form id="reservationForm" action="{{ route('reservation.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="annonce_id" value="{{ $annonce->id }}">
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="date_debut" class="block mb-2 text-sm font-medium text-gray-900">
                                    <i class="far fa-calendar mr-1"></i> Date de début
                                </label>
                                <input type="text" id="date_debut" name="date_debut" 
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                                       placeholder="Sélectionner une date" required readonly>
                            </div>
                            <div>
                                <label for="date_fin" class="block mb-2 text-sm font-medium text-gray-900">
                                    <i class="far fa-calendar mr-1"></i> Date de fin
                                </label>
                                <input type="text" id="date_fin" name="date_fin" 
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                                       placeholder="Sélectionner une date" required readonly>
                            </div>
                        </div>
                        
                        <div id="priceCalculation" class="mb-4 hidden bg-white p-3 rounded-lg shadow-sm">
                            <div class="flex justify-between mb-1">
                                <span class="text-gray-600">Durée:</span>
                                <span id="durationDays" class="font-medium">0 jours</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Prix journalier:</span>
                                <span class="font-medium">{{ number_format($annonce->prix_journalier, 2) }} MAD</span>
                            </div>
                            <div class="border-t my-2"></div>
                            <div class="flex justify-between">
                                <span class="text-lg font-semibold">Total:</span>
                                <span id="totalPrice" class="text-lg font-bold text-blue-600">0.00 MAD</span>
                            </div>
                        </div>
                        
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center">
                            <i class="fas fa-check-circle mr-2"></i> Réserver maintenant
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Reviews Section -->
    <div class="mt-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Object Reviews -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">
                    <i class="fas fa-comment-alt mr-2"></i>Avis sur le jouet
                </h2>
                
                @php
                    $averageObjetRating = $evaluationsObjet->avg('note');
                    $reviewCount = $evaluationsObjet->count();
                @endphp
                
                <div class="flex items-center mb-6">
                    <div class="text-4xl font-bold mr-4">{{ number_format($averageObjetRating, 1) }}/5</div>
                    <div>
                        <div class="flex items-center mb-1">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $averageObjetRating)
                                    <i class="fas fa-star text-yellow-400"></i>
                                @elseif($i == ceil($averageObjetRating) && ($averageObjetRating - floor($averageObjetRating) >= 0.5))
                                    <i class="fas fa-star-half-alt text-yellow-400"></i>
                                @else
                                    <i class="far fa-star text-gray-300"></i>
                                @endif
                            @endfor
                        </div>
                        <p class="text-sm text-gray-600">Basé sur {{ $reviewCount }} avis</p>
                    </div>
                </div>
                
                @if($reviewCount > 0)
                    <div class="space-y-4">
                        @foreach($evaluationsObjet->take(3) as $evaluation)
                            <div class="border-b border-gray-200 pb-4 last:border-0 last:pb-0">
                                <div class="flex items-center mb-2">
                                    <img class="w-8 h-8 rounded-full mr-2 object-cover" 
                                         src="{{ $evaluation->client->image_profil }}" 
                                         alt="{{ $evaluation->client->surnom }}">
                                    <div>
                                        <p class="font-medium">{{ $evaluation->client->surnom }}</p>
                                        <div class="flex items-center">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $evaluation->note)
                                                    <i class="fas fa-star text-yellow-300 text-xs"></i>
                                                @else
                                                    <i class="far fa-star text-gray-300 text-xs"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <p class="text-gray-600">{{ $evaluation->commentaire }}</p>
                                <p class="text-xs text-gray-400 mt-1">
                                    {{ \Carbon\Carbon::parse($evaluation->created_at)->diffForHumans() }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                    
                    @if($reviewCount > 3)
                        <div class="mt-4 text-center">
                            <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Voir tous les avis ({{ $reviewCount }})
                            </a>
                        </div>
                    @endif
                @else
                    <p class="text-gray-500 text-center py-4">
                        <i class="far fa-comment-dots fa-2x mb-2"></i><br>
                        Aucun avis pour ce jouet.
                    </p>
                @endif
            </div>
            
            <!-- Partner Reviews -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">
                    <i class="fas fa-user-tie mr-2"></i>Avis sur le partenaire
                </h2>
                
                @php
                    $averagePartnerRating = $evaluationsPartner->avg('note');
                    $partnerReviewCount = $evaluationsPartner->count();
                @endphp
                
                <div class="flex items-center mb-6">
                    <div class="text-4xl font-bold mr-4">{{ number_format($averagePartnerRating, 1) }}/5</div>
                    <div>
                        <div class="flex items-center mb-1">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $averagePartnerRating)
                                    <i class="fas fa-star text-yellow-400"></i>
                                @elseif($i == ceil($averagePartnerRating) && ($averagePartnerRating - floor($averagePartnerRating) >= 0.5))
                                    <i class="fas fa-star-half-alt text-yellow-400"></i>
                                @else
                                    <i class="far fa-star text-gray-300"></i>
                                @endif
                            @endfor
                        </div>
                        <p class="text-sm text-gray-600">Basé sur {{ $partnerReviewCount }} avis</p>
                    </div>
                </div>
                
                @if($partnerReviewCount > 0)
                    <div class="space-y-4">
                        @foreach($evaluationsPartner->take(3) as $evaluation)
                            <div class="border-b border-gray-200 pb-4 last:border-0 last:pb-0">
                                <div class="flex items-center mb-2">
                                    <img class="w-8 h-8 rounded-full mr-2 object-cover" 
                                         src="{{ $evaluation->client->image_profil }}" 
                                         alt="{{ $evaluation->client->surnom }}">
                                    <div>
                                        <p class="font-medium">{{ $evaluation->client->surnom }}</p>
                                        <div class="flex items-center">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $evaluation->note)
                                                    <i class="fas fa-star text-yellow-300 text-xs"></i>
                                                @else
                                                    <i class="far fa-star text-gray-300 text-xs"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <p class="text-gray-600">{{ $evaluation->commentaire }}</p>
                                <p class="text-xs text-gray-400 mt-1">
                                    {{ \Carbon\Carbon::parse($evaluation->created_at)->diffForHumans() }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                    
                    @if($partnerReviewCount > 3)
                        <div class="mt-4 text-center">
                            <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Voir tous les avis ({{ $partnerReviewCount }})
                            </a>
                        </div>
                    @endif
                @else
                    <p class="text-gray-500 text-center py-4">
                        <i class="far fa-comment-dots fa-2x mb-2"></i><br>
                        Aucun avis pour ce partenaire.
                    </p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Passer les données PHP à JavaScript -->
<script>
    window.reservationData = {
        reservedPeriods: @json($reservedPeriods),
        annonceStartDate: '{{ \Carbon\Carbon::parse($annonce->date_debut)->format("Y-m-d") }}',
        annonceEndDate: '{{ \Carbon\Carbon::parse($annonce->date_fin)->format("Y-m-d") }}',
        dailyPrice: {{ $annonce->prix_journalier }},
        locale: 'fr',
        currency: 'MAD'
    };
</script> 

 <!-- Initialiser Swiper pour la galerie d'images -->
 @if($annonce->objet->images->isNotEmpty())
 <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
 <script>
     document.addEventListener('DOMContentLoaded', function() {
         new Swiper('.swiper-container', {
             loop: true,
             pagination: {
                 el: '.swiper-pagination',
                 clickable: true,
             },
             navigation: {
                 nextEl: '.swiper-button-next',
                 prevEl: '.swiper-button-prev',
             },
         });
     });
 </script>
 @endif
 @show
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/fr.js"></script>
<!-- Custom JS -->
<script src="{{ asset('js/annonce-details.js') }}"></script>
@stack('scripts')
</body>
</html>