<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Annonces</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    @include('components.sideBar')

    <div class="flex flex-col md:flex-row">
        
        <!-- Filter Sidebar -->
        <form id="mainFilterForm" method="GET" action="{{ route('annonces') }}" class="w-full md:w-64 bg-white p-5 shadow-md sticky-sidebar md:mt-4 md:ml-4">
            <div class="flex justify-between items-center mb-5">
                <h2 class="text-xl font-bold">Filtres</h2>
            </div>

            <!-- Tranche d'âge Filter -->
            <div class="mb-6">
                <h3 class="font-semibold mb-3 text-gray-700">Tranche d'âge</h3>
                @foreach (['<3', '3-5', '6-8', '9-12', '13+'] as $age)
                    <div class="flex items-center">
                        <input type="radio" name="age" value="{{ $age }}" 
                               {{ request('age') == $age ? 'checked' : '' }} 
                               class="mr-2 rounded text-blue-500 filter-input">
                        <label class="text-gray-600">{{ $age == '<3' ? 'Moins de 3 ans' : $age . ' ans' }}</label>
                    </div>
                @endforeach
            </div>

            <!-- Prix Filter -->
            <div class="mb-6">
                <h3 class="font-semibold mb-3 text-gray-700">Prix</h3>
                @foreach (['0-50' => 'Moins de 50Dhs', '50-100' => '50Dhs - 100Dhs', '100-150' => '100Dhs - 150Dhs', '150+' => 'Plus de 150Dhs'] as $val => $label)
                    <div class="flex items-center">
                        <input type="radio" name="price" value="{{ $val }}" 
                               {{ request('price') == $val ? 'checked' : '' }} 
                               class="mr-2 rounded text-blue-500 filter-input">
                        <label class="text-gray-600">{{ $label }}</label>
                    </div>
                @endforeach
            </div>

            <!-- Type Filter -->
            <div class="mb-6">
                <h3 class="font-semibold mb-3 text-gray-700">Type</h3>
                @foreach (['Jeux éducatifs', 'Jeux d\'amusement', 'Jeux créatifs', 'Jeux de stratégie'] as $type)
                    <div class="flex items-center">
                        <input type="radio" name="type" value="{{ $type }}" 
                               {{ request('type') == $type ? 'checked' : '' }} 
                               class="mr-2 rounded text-blue-500 filter-input">
                        <label class="text-gray-600">{{ $type }}</label>
                    </div>
                @endforeach
            </div>

            <input type="hidden" name="search" id="searchInput" value="{{ request('search') }}">
            <input type="hidden" name="sort" id="sortInput" value="{{ request('sort') }}">
            <a href="{{ route('annonces') }}" class="flex-2 bg-gray-200 text-gray-700 py-2 rounded hover:bg-gray-300 transition text-center">
                    Réinitialiser
                </a>
        </form>

        <!-- Main Content Area -->
        <div class="flex-1 p-5">
            <!-- Sorting and Search Filters -->
            <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
                <div class="w-full flex flex-col sm:flex-row gap-4 items-center">
                    <div class="flex items-center w-full sm:w-auto">
                        <span class="text-gray-600 mr-2 text-sm md:text-base">Trier par :</span>
                        <select name="sort" id="sortSelect" class="bg-white border border-gray-300 rounded px-3 py-2 text-sm md:text-base focus:outline-none focus:ring-1 focus:ring-blue-500">
                            <option value="">--</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Prix croissant</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Prix décroissant</option>
                        </select>
                    </div>

                    <div class="relative w-full sm:w-64">
                        <input type="text" name="search" id="searchField" value="{{ request('search') }}" 
                               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-white shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500" 
                               placeholder="Rechercher...">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Annonces List -->
            <section class="w-fit mx-auto grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 justify-items-center justify-center gap-y-20 gap-x-14 mt-10 mb-5">
                @forelse ($annonces as $annonce)
                    <div class="w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
                        <a href="#">
                            <img src="{{ $annonce->image_url ?? 'https://via.placeholder.com/288x320' }}" alt="{{ $annonce->objet->nom }}" class="h-80 w-72 object-cover rounded-t-xl" />
                            <div class="px-4 py-3 w-72">
                                <p class="text-lg font-bold text-black truncate block capitalize">{{ $annonce->objet->nom }}</p>
                                <div class="flex items-center justify-between mt-2">
                                    <p class="text-lg font-semibold text-black">{{ $annonce->prix_journalier }} Dhs</p>
                                    <a href="{{ route('annonceID', ['id' => $annonce->id]) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">
                                        Découvrir
                                    </a>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <p class="text-center col-span-full text-gray-600">Aucun produit trouvé.</p>
                @endforelse
            </section>

            <!-- Pagination -->
            <div class="flex justify-center mt-12">
                {{ $annonces->withQueryString()->links() }}
            </div>

        </div>
    </div>

    <!-- Scripts -->
    <script>
        //  dynamic filter 
        document.querySelectorAll('.filter-input').forEach(input => {
            input.addEventListener('change', function() {
                document.getElementById('mainFilterForm').submit(); // Automatically submit form
            });
        });

        // search input 
        document.getElementById('searchField').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                document.getElementById('searchInput').value = this.value;
                document.getElementById('mainFilterForm').submit();
            }
        });

        //  sorting
        document.getElementById('sortSelect').addEventListener('change', function() {
            document.getElementById('sortInput').value = this.value;
            document.getElementById('mainFilterForm').submit();
        });
    </script>
</body>
</html>
