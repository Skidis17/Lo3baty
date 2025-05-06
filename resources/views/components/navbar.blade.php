<nav class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <img src="{{ asset('images/lo3baty.jpg') }}" alt="Logo" class="h-8 w-auto">
            </div>

            <!-- Navigation Links -->
            <div class="hidden md:flex space-x-6">
            <a href="{{ route('accueil') }}" class="px-3 py-2 text-sm font-medium hover:text-blue-500 transition-colors">
            Accueil
                </a>
                <a href="{{ route('annonces') }}" class="text-blue-500">Annonces</a>
                </a>
                <a href="{{ route('reservations') }}" class=" px-3 py-2 text-sm font-medium hover:text-blue-500 transition-colors">
                    Réservations
                </a>
            </div>

            <!-- User Section -->
            @include('components.user_toggle')
        </div>
    </div>
</nav>