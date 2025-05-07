<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    @vite('resources/css/app.css')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body  class="bg-gray-50 ">

@include('components.navbar')

<!-- Hero Section -->
<section class="relative h-[600px] bg-gray-900">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1587654780291-39c9404d746b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80" 
             class="w-full h-full object-cover opacity-50" alt="Kids playing">
    </div>
    
    <div class="relative max-w-7xl mx-auto h-full px-4 flex items-center">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 w-full">
            <!-- Text Content -->
            <div class="text-white space-y-6">
                <h1 class="text-4xl md:text-5xl font-bold leading-tight">
                    Louez des jouets pour<br>
                    vos enfants à Tétouan
                </h1>
                <p class="text-xl text-gray-200">
                    Pourquoi acheter quand vous pouvez louer? Accédez à des milliers de jouets pour tous les âges.
                </p>
            </div>

            <!-- Search Card -->
            <div class="bg-white rounded-2xl p-8 shadow-2xl">
                <div class="space-y-6">
                    <h3 class="text-2xl font-bold text-gray-900">Quel jouet recherchez-vous?</h3>
                    
                    <div class="space-y-4">
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <span class="text-gray-500">Ville</span>
                            <p class="font-medium">Tétouan, Maroc</p>
                        </div>
                        
                        <input type="text" 
                               placeholder="Ex: Vélo, Poupée, Lego..." 
                               class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">
                        
                        <button class="w-full bg-blue-600 text-white py-3 rounded-lg font-medium hover:bg-blue-700 transition">
                            Rechercher
                        </button>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <span class="text-sm text-gray-600">Suggestions :</span>
                        <a href="#" class="px-3 py-1 bg-gray-100 rounded-full text-sm hover:bg-gray-200">Jeux Éducatifs</a>
                        <a href="#" class="px-3 py-1 bg-gray-100 rounded-full text-sm hover:bg-gray-200">Jeux d'Extérieur</a>
                        <a href="#" class="px-3 py-1 bg-gray-100 rounded-full text-sm hover:bg-gray-200">Jeux de Société</a>
                        <a href="#" class="px-3 py-1 bg-gray-100 rounded-full text-sm hover:bg-gray-200">Jeux Électroniques</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works -->
<section class="py-20 bg-amber-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Comment ça marche?</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Louez des jouets pour vos enfants en quelques étapes simples</p>
        </div>

        <div class="grid md:grid-cols-4 gap-8">
            <!-- Step 1 -->
            <div class="p-6 bg-gray-50 rounded-xl hover:shadow-lg transition">
                <div class="w-12 h-12 bg-blue-600 rounded-lg mb-4 flex items-center justify-center text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Trouvez le jouet parfait</h3>
                <p class="text-gray-600">Parcourez notre large sélection de jouets disponibles à Tétouan</p>
            </div>

            <!-- Step 2 -->
            <div class="p-6 bg-gray-50 rounded-xl hover:shadow-lg transition">
                <div class="w-12 h-12 bg-blue-600 rounded-lg mb-4 flex items-center justify-center text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Réservez simplement</h3>
                <p class="text-gray-600">Choisissez vos dates et payez en ligne de manière sécurisée</p>
            </div>

            <!-- Step 3 -->
            <div class="p-6 bg-gray-50 rounded-xl hover:shadow-lg transition">
                <div class="w-12 h-12 bg-blue-600 rounded-lg mb-4 flex items-center justify-center text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Récupérez le jouet</h3>
                <p class="text-gray-600">Retrait chez le partenaire ou livraison à domicile</p>
            </div>

            <!-- Step 4 -->
            <div class="p-6 bg-gray-50 rounded-xl hover:shadow-lg transition">
                <div class="w-12 h-12 bg-blue-600 rounded-lg mb-4 flex items-center justify-center text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Profitez et ramenez</h3>
                <p class="text-gray-600">Amusez-vous puis retournez le jouet en bon état</p>
            </div>
        </div>
    </div>
</section>

<!-- Dynamic Cards Section -->
<section id="annonces" class="py-20 bg-emerald-50">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Annonces de Jouets</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($objet as $objet)
                @php
                    $annonce = $objet->annonces->first();
                  
                @endphp

                <div 
                    class="relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 cursor-pointer group"
                >
                    <!-- Category Ribbon -->
                    <div class="absolute -top-3 -right-3 z-10">
                        <span class=" px-3 py-1 rounded-full text-sm font-medium shadow-md">
                        </span>
                    </div>

                    <!-- Image Section -->
                    <div class="relative h-64 overflow-hidden rounded-t-2xl">
                        @if ($objet->images->first())
                            <img 
                                src="{{ asset($objet->images->first()->url) }}" 
                                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                                alt="{{ $objet->nom }}">
                        @else
                            <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif

                        <!-- Price and Rating Badge -->
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-gray-900 via-gray-900/70 to-transparent p-4">
                            <div class="flex justify-between items-end">
                                <div>
                                    <span class="text-white font-bold text-xl">{{ $annonce->prix_journalier }} DH/jour</span>
                                    <div class="flex items-center mt-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        @endfor
                                        <span class="ml-2 text-white text-sm"></span>
                                    </div>
                                </div>
                                @if ($annonce->premium)
                                    <div class="flex items-center bg-yellow-500/90 px-3 py-1 rounded-full">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5 2a2 2 0 012-2h6a2 2 0 012 2v2h2a2 2 0 012 2v9a2 2 0 01-2 2H3a2 2 0 01-2-2V6a2 2 0 012-2h2V2zm6 0H9v2h2V2z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Content Section -->
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-xl font-bold text-gray-900">{{ $objet->nom }}</h3>
                            <span class="text-sm text-gray-500">{{ $annonce->date_publication }}</span>
                        </div>

                        <p class="text-gray-600 text-sm mb-4">{{ Str::limit($objet->description, 100) }}</p>

                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>{{ $annonce->adresse }}</span>
                        </div>
                    </div>

                    <!-- Hover Overlay -->
                    <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-2xl flex items-center justify-center">
                    @if ($annonce)
                        <a href="{{ route('annonceID', ['id' => $annonce->id]) }}" class="inline-flex items-center text-blue-600 font-medium hover:text-blue-800">
                        Voir plus
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Add this to your layout file -->
<style>
    .group:hover .group-hover\:scale-105 {
        transform: scale(1.05);
    }
</style>


<!-- Footer -->
<footer class="bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid md:grid-cols-4 gap-8">
            <!-- Platform Info -->
            <div class="space-y-4">
                <img src="{{ asset('images/lo3baty.jpg') }}" class="h-16 w-auto mb-8" alt="Logo">
                <p class="text-gray-400">La solution simple et pratique pour louer des jouets à Tétouan</p>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-lg font-semibold mb-4">Navigation</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('acceuil') }}" class="text-gray-400 hover:text-white">Accueil</a></li>
                    <li><a href="{{ route('annonces') }}" class="text-gray-400 hover:text-white">Annonces</a></li>
                    <li><a href="{{ route('reservations') }}" class="text-gray-400 hover:text-white">Réservations</a></li>
                </ul>
            </div>


            <!-- Contact infos-->
            <div>
                <h4 class="text-lg font-semibold mb-4">Contact</h4>
                <ul class="space-y-2">
                    <li class="text-gray-400">contact@jouets-tetouan.ma</li>
                    <li class="text-gray-400">+212 6 12 34 56 78</li>
                </ul>
            </div>



            <!-- Social media and stufffs-->
            <div>
                <h4 class="text-lg font-semibold mb-4">Suivez-nous</h4>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm3 8h-1.35c-.538 0-.65.221-.65.778v1.222h2l-.209 2h-1.791v7h-3v-7h-2v-2h2v-2.308c0-1.769.931-2.692 3.029-2.692h1.971v3z"/></svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
            &copy; 2025 Jouets Tétouan. Tous droits réservés.
        </div>
    </div>
</footer>

</body>
</html>