@section('content')
<div class="max-w-5xl mx-auto py-10 px-4">
    {{-- Bloc Jouet --}}
    <div class="bg-white rounded-2xl shadow-md p-6 mb-12">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $objet->nom }}</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Image principale --}}
            @if($objet->image)
    <img src="{{ asset('images/default-toy.png' . $objet->image) }}" alt="Image du jouet" class="w-full h-64 object-cover rounded-xl">
@else
    <div class="bg-gray-200 w-full h-64 flex items-center justify-center rounded-xl text-gray-500">Aucune image</div>
@endif


            {{-- Infos --}}
            <div>
                <p class="text-gray-700"><strong>Description :</strong> {{ $objet->description }}</p>
                <p class="text-gray-700 mt-2"><strong>Ville :</strong> {{ $objet->ville }}</p>
                <p class="text-gray-700 mt-2"><strong>État :</strong> {{ $objet->etat }}</p>
                <p class="text-gray-700 mt-2"><strong>Prix journalier :</strong> {{ $objet->prix_journalier }} MAD</p>
                <p class="text-gray-700 mt-2"><strong>Créé le :</strong> {{ $objet->created_at->format('d/m/Y') }}</p>

                <a href="#proprietaire" class="inline-block mt-6 text-blue-600 font-semibold hover:underline">
                    Voir le propriétaire ↓
                </a>
            </div>
        </div>
    </div>

    {{-- Bloc Propriétaire --}}
    <div id="proprietaire" class="bg-gray-50 rounded-2xl shadow-inner p-6">
        <h2 class="text-2xl font-semibold mb-4 text-gray-800">Informations du propriétaire</h2>
        <div class="flex items-center gap-6">
            {{-- Image de profil --}}
            @if($objet->proprietaire->image_profil)
            <img src="{{ asset('images/default-avatar.png' . $objet->proprietaire->image_profil) }}" alt="Profil"
                 class="w-24 h-24 rounded-full border-4 border-white shadow-md object-cover">
        @else
            <div class="w-24 h-24 bg-gray-300 rounded-full flex items-center justify-center text-white">
                <span class="text-lg font-bold">N/A</span>
            </div>
        @endif
        

            {{-- Infos texte --}}
            <div>
                <p class="text-gray-700"><strong>Nom :</strong> {{ $objet->proprietaire->nom }} {{ $objet->proprietaire->prenom }}</p>
                <p class="text-gray-700"><strong>Email :</strong> {{ $objet->proprietaire->email }}</p>
            </div>
        </div>
    </div>
</div>
