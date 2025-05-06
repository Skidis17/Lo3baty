@extends('Admin.layouts.app')

@section('title', 'Gestion des Partenaires')

@section('content')
<div class="flex">
    @include('admin.layouts.sidebar')

    <div class="flex-1 p-6 space-y-6">
        <!-- Notification -->
        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
        @endif

        <!-- Tableau -->
        <div class="bg-white rounded-lg shadow overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-6 py-3 text-left">Nom</th>
                        <th class="px-6 py-3 text-left">Email</th>
                        <th class="px-6 py-3 text-left">Statut</th>
                        <th class="px-6 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($partenaires as $partenaire)
                    <tr class="border-b">
                        <td class="px-6 py-4">{{ $partenaire->prenom }} {{ $partenaire->nom }}</td>
                        <td class="px-6 py-4">{{ $partenaire->email }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded-full text-xs {{ $partenaire->isActive() ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $partenaire->isActive() ? 'Actif' : 'Inactif' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <form method="POST" action="{{ route('admin.partenaires.toggle-status', $partenaire) }}">
                                @csrf
                                <button type="submit" class="px-3 py-1 text-xs rounded {{ $partenaire->isActive() ? 'bg-red-500 text-white' : 'bg-green-500 text-white' }}">
                                    {{ $partenaire->isActive() ? 'Désactiver' : 'Activer' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="px-6 py-3">
                {{ $partenaires->links() }}
            </div>
        </div>
    </div>
</div>
@endsection