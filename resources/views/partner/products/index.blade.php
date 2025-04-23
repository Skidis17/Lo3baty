@extends('layouts.partner')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Mes Produits</h1>
        <a href="{{ route('partner.products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">+ Ajouter</a>
    </div>

    @if(session('success'))
        <div class="mb-4 text-green-600 font-medium">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow-md rounded">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3">Nom</th>
                    <th class="p-3">Catégorie</th>
                    <th class="p-3">Prix</th>
                    <th class="p-3">Ville</th>
                    <th class="p-3">État</th>
                    <th class="p-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">{{ $product->nom }}</td>
                    <td class="p-3">{{ $product->categorie->nom ?? '-' }}</td>
                    <td class="p-3">{{ $product->prix_journalier }} MAD/j</td>
                    <td class="p-3">{{ $product->ville }}</td>
                    <td class="p-3">{{ $product->etat }}</td>
                    <td class="p-3 text-right space-x-2">
                        <a href="{{ route('partner.products.edit', $product) }}" class="text-blue-500 hover:underline">Modifier</a>
                        <form action="{{ route('partner.products.destroy', $product) }}" method="POST" class="inline-block" onsubmit="return confirm('Confirmer la suppression ?');">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500 hover:underline">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @if($products->isEmpty())
                <tr>
                    <td colspan="6" class="p-4 text-center text-gray-400">Aucun produit trouvé</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
