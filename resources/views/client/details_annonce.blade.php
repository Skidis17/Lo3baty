<!DOCTYPE html>
<html lang="fr" x-data="{ isFavorite: false, showScrollTop: false }" x-init="window.onscroll = () => { showScrollTop = window.scrollY > 300 }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail d'annonce - Jouets d'enfants</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Animate.css pour WOW.js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    
    <!-- Alpine JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/annonce-details.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/fr.js"></script>
</head>
<body class="bg-gray-50 font-sans" x-data="{ activeTab: 'reviews' }">
    @include('components.navbar')
    <!-- Scroll to Top Button -->
    <div x-show="showScrollTop" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-y-2"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform translate-y-2"
         class="fixed bottom-8 right-8 z-50">
        <button @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
                class="p-3 bg-yellow-500 text-white rounded-full shadow-lg hover:bg-blue-600 transition-all duration-300 hover:scale-110">
            <i class="fas fa-arrow-up"></i>
        </button>
    </div>
    <div class="min-h-screen">
        @section('content')
        <div class="container mx-auto px-4 py-8">
            <!-- Breadcrumb avec animation -->
            <nav class="flex mb-6 wow animate__fadeIn" data-wow-delay="0.1s">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ url('/') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                            <i class="fas fa-home mr-2"></i> Accueil
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Détails du jouet</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Annonce Details -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden wow animate__fadeIn">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4">
                    <!-- Image Gallery -->
                    <div class="md:col-span-1 wow animate__fadeInLeft">
                        @if($annonce->objet->images->isNotEmpty())
                            <div class="swiper-container relative rounded-xl overflow-hidden shadow-lg">
                                @if($annonce->premium)
                                    <div class="premium-badge">
                                        <i class="fas fa-crown mr-1"></i> Premium
                                    </div>
                                @endif
                                <div class="swiper-wrapper">
                                    @foreach($annonce->objet->images as $image)
                                        <div class="swiper-slide">
                                            <img src="{{ asset($image->url) }}" alt="{{ $annonce->objet->nom }}" 
                                                 class="w-full h-96 object-cover transition duration-300 hover:scale-105">
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-pagination"></div>
                                <div class="swiper-button-next bg-white/80 rounded-full w-10 h-10 flex items-center justify-center hover:bg-white transition"></div>
                                <div class="swiper-button-prev bg-white/80 rounded-full w-10 h-10 flex items-center justify-center hover:bg-white transition"></div>
                            </div>
                        @else
                            <div class="bg-gradient-to-r from-pink-100 to-purple-100 h-96 flex items-center justify-center rounded-lg shadow-inner">
                                <span class="text-gray-500 text-center">
                                    <i class="fas fa-image fa-2x mb-2"></i><br>
                                    Aucune image disponible
                                </span>
                            </div>
                        @endif
                    </div>

                    <!-- Details Section -->
                    <div class="md:col-span-1 p-4 wow animate__fadeInRight" data-wow-delay="0.2s">
                        <h1 class="text-3xl font-bold text-gray-800 mb-2 font-kids">{{ $annonce->objet->nom }}</h1>
                        
                        <!-- Partner Info -->
                        <div class="flex items-center mb-4 p-3 bg-blue-50 rounded-lg">
                            <div class="flex-shrink-0">
                                <img class="w-12 h-12 rounded-full object-cover border-2 border-white shadow" 
                                     src="{{ $annonce->proprietaire->image_profil }}" 
                                     alt="{{ $annonce->proprietaire->surnom }}">
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">
                                    Proposé par <span class="font-semibold">{{ $annonce->proprietaire->surnom }}</span>
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
                            <span class="price-tag text-xs font-medium px-3 py-1 rounded-full shadow-sm">
                                {{ number_format($annonce->prix_journalier, 2) }} MAD/jour
                            </span>
                           
                        </div>

                        <!-- Description -->
                        <div class="mb-6 bg-blue-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2 flex items-center">
                                <i class="fas fa-align-left mr-2 text-blue-500"></i>Description
                            </h3>
                            <p class="text-gray-600">{{ $annonce->objet->description }}</p>
                        </div>

                        <!-- Details Grid -->
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div class="bg-white p-3 rounded-lg shadow-sm border border-gray-100">
                                <p class="text-sm text-gray-500 flex items-center">
                                    <i class="fas fa-city mr-2 text-blue-400"></i> Ville
                                </p>
                                <p class="font-medium mt-1">{{ $annonce->objet->ville }}</p>
                            </div>
                            <div class="bg-white p-3 rounded-lg shadow-sm border border-gray-100">
                                <p class="text-sm text-gray-500 flex items-center">
                                    <i class="fas fa-battery-three-quarters mr-2 text-green-400"></i> État
                                </p>
                                <p class="font-medium mt-1">{{ $annonce->objet->etat }}</p>
                            </div>
                            <div class="bg-white p-3 rounded-lg shadow-sm border border-gray-100">
                                <p class="text-sm text-gray-500 flex items-center">
                                    <i class="far fa-calendar-alt mr-2 text-purple-400"></i> Date de publication
                                </p>
                                <p class="font-medium mt-1">
                                    {{ \Carbon\Carbon::parse($annonce->date_publication)->format('d/m/Y') }}
                                </p>
                            </div>
                            <div class="bg-white p-3 rounded-lg shadow-sm border border-gray-100">
                                <p class="text-sm text-gray-500 flex items-center">
                                    <i class="fas fa-child mr-2 text-pink-400"></i> Tranche d'âge
                                </p>
                                <p class="font-medium mt-1">
                                    {{ $annonce->objet->tranche_age}} 
                                </p>
                            </div>
                        </div>

                        <!-- Reservation Section -->
                        <div class="reservation-section bg-gradient-to-br from-blue-50 to-purple-50 p-4 rounded-lg shadow-inner wow animate__fadeInUp" data-wow-delay="0.3s">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <i class="far fa-calendar-plus mr-2 text-purple-500"></i>Réserver ce jouet
                            </h3>
                            
                            <!-- Calendar -->
                            <div class="mb-6">
                               <div id="calendarContainer" class="my-8 p-4 border rounded-lg shadow-md"></div>
                            </div>

                            <!-- Form -->
                            <form id="reservationForm" action="{{ route('reservation.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="annonce_id" value="{{ $annonce->id }}">
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label for="date_debut" class="block mb-2 text-sm font-medium text-gray-900">
                                            <i class="far fa-calendar mr-1 text-blue-500"></i> Date de début
                                        </label>
                                        <input type="text" id="date_debut" name="date_debut" 
                                               class="bg-white border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 shadow-sm" 
                                               placeholder="Sélectionner une date" required readonly>
                                    </div>
                                    <div>
                                        <label for="date_fin" class="block mb-2 text-sm font-medium text-gray-900">
                                            <i class="far fa-calendar mr-1 text-blue-500"></i> Date de fin
                                        </label>
                                        <input type="text" id="date_fin" name="date_fin" 
                                               class="bg-white border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 shadow-sm" 
                                               placeholder="Sélectionner une date" required readonly>
                                    </div>
                                </div>
                                
                                <div id="priceCalculation" class="mb-4 hidden bg-white p-4 rounded-lg shadow-sm border border-blue-100 animate__animated animate__fadeIn">
                                    <div class="flex justify-between mb-2">
                                        <span class="text-gray-600">Durée:</span>
                                        <span id="durationDays" class="font-medium">0 jours</span>
                                    </div>
                                    <div class="flex justify-between mb-2">
                                        <span class="text-gray-600">Prix journalier:</span>
                                        <span class="font-medium">{{ number_format($annonce->prix_journalier, 2) }} MAD</span>
                                    </div>
                                    <div class="border-t my-2 border-dashed"></div>
                                    <div class="flex justify-between">
                                        <span class="text-lg font-semibold">Total:</span>
                                        <span id="totalPrice" class="text-lg font-bold text-blue-600">0.00 MAD</span>
                                    </div>
                                </div>
                                
                                <button type="submit" class="w-full btn-primary text-white font-medium py-3 px-4 rounded-lg flex items-center justify-center shadow-lg hover:shadow-xl">
                                    <i class="fas fa-check-circle mr-2"></i> Réserver maintenant
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reviews Section -->
            <div class="mt-12">
                <!-- Tabs Navigation -->
                <div class="flex border-b border-gray-200 mb-6 wow animate__fadeIn">
                    <button @click="activeTab = 'reviews'" 
                            :class="{'border-b-2 border-blue-500 text-blue-600': activeTab === 'reviews'}" 
                            class="px-4 py-2 font-medium text-sm focus:outline-none">
                        <i class="fas fa-star mr-1"></i> Avis ({{ $evaluationsObjet->count() + $evaluationsPartner->count() }})
                    </button>
                    <button @click="activeTab = 'related'" 
                            :class="{'border-b-2 border-blue-500 text-blue-600': activeTab === 'related'}" 
                            class="px-4 py-2 font-medium text-sm focus:outline-none">
                        <i class="fas fa-th-large mr-1"></i> Jouets similaires
                    </button>
                </div>

                <div x-show="activeTab === 'reviews'" class="wow animate__fadeIn" data-wow-delay="0.1s">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Object Reviews -->
                        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                            <h2 class="text-xl font-bold text-gray-800 mb-4">
                                <i class="fas fa-comment-alt mr-2 text-purple-500"></i>Avis sur le jouet
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
                                                <img class="w-8 h-8 rounded-full mr-2 object-cover border-2 border-white shadow" 
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
                                        <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium inline-flex items-center">
                                            Voir tous les avis ({{ $reviewCount }}) <i class="fas fa-arrow-right ml-1"></i>
                                        </a>
                                    </div>
                                @endif
                            @else
                                <p class="text-gray-500 text-center py-4">
                                    <i class="far fa-comment-dots fa-2x mb-2 text-gray-300"></i><br>
                                    Aucun avis pour ce jouet.
                                </p>
                            @endif
                        </div>
                        
                        <!-- Partner Reviews -->
                        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                            <h2 class="text-xl font-bold text-gray-800 mb-4">
                                <i class="fas fa-user-tie mr-2 text-blue-500"></i>Avis sur le partenaire
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
                                                <img class="w-8 h-8 rounded-full mr-2 object-cover border-2 border-white shadow" 
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
                                                {{$evaluation->created_at ? \Carbon\Carbon::parse($evaluation->created_at)->diffForHumans() : 'N/A'}}
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                                
                                @if($partnerReviewCount > 3)
                                    <div class="mt-4 text-center">
                                        <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium inline-flex items-center">
                                            Voir tous les avis ({{ $partnerReviewCount }}) <i class="fas fa-arrow-right ml-1"></i>
                                        </a>
                                    </div>
                                @endif
                            @else
                                <p class="text-gray-500 text-center py-4">
                                    <i class="far fa-comment-dots fa-2x mb-2 text-gray-300"></i><br>
                                    Aucun avis pour ce partenaire.
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                <div x-show="activeTab === 'related'" class="wow animate__fadeIn" data-wow-delay="0.2s">
                    <!-- Related Products Section -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-2xl font-bold mb-6 flex items-center">
                            <i class="fas fa-th-large mr-2 text-blue-500"></i> Jouets Similaires
                        </h2>
                        
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                            @foreach($relatedProduits as $produit)
                                @php
                                    $annonce = $produit->annonces->first();
                                @endphp
                                
                                <a href="{{ route('annonceID', ['id' => $annonce->id]) }}" 
                                   class="toy-card group">
                                    <div class="relative h-48 overflow-hidden rounded-t-lg bg-gradient-to-br from-pink-50 to-blue-50">
                                        @if($produit->images->first())
                                            @if($annonce->premium)
                                                <div class="premium-badge">
                                                    <i class="fas fa-crown mr-1"></i> Premium
                                                </div>
                                            @endif
                                            <img src="{{ asset($produit->images->first()->url) }}" 
                                                 class="w-full h-full object-cover duration-300 group-hover:scale-110 transition-transform"
                                                 alt="{{ $produit->nom }}">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <i class="fas fa-image text-gray-400 text-3xl"></i>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="p-4 bg-white">
                                        <h3 class="font-medium text-black-900 truncate">{{ $produit->nom }}</h3>
                                        <div class="mt-2 flex items-center justify-between">
                                            <span class="text-lg font-bold text-emerald-600">
                                                {{ $annonce->prix_journalier }} DH/jour
                                            </span>
                                            <span class="px-2 py-1 text-xs rounded-full {{ $produit->etat === 'Neuf' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                                {{ ucfirst($produit->etat) }}
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        <!-- View All Products Button -->
                        <div class="mt-8 flex justify-center">
                            <a href="{{ route('annonces') }}" 
                               class="btn-primary text-white px-6 py-3 rounded-lg font-medium inline-flex items-center">
                                Voir tous nos jouets <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>

                        @if($relatedProduits->isEmpty())
                            <div class="text-center py-8 text-gray-500">
                                <i class="fas fa-search fa-2x mb-2 text-gray-300"></i><br>
                                Aucun jouet similaire trouvé
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @show
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/fr.js"></script>
    <!-- WOW.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    
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

    <!-- Initialiser WOW.js -->
    <script>
        new WOW().init();
    </script>

    <!-- Initialiser Swiper pour la galerie d'images -->
    @if($annonce->objet->images->isNotEmpty())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Swiper('.swiper-container', {
                loop: true,
                autoplay: {
                    delay: 3000,
                },
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

    <!-- Custom JS -->
    <script src="{{ asset('js/annonce-details.js') }}"></script>
    @stack('scripts')
</body>
</html>