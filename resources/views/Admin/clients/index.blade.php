@extends('Admin.layouts.app')

@section('title', 'Gestion des clients')

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

        <!-- Tableau des clients -->
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
                    @foreach($clients as $client)
                    <tr class="border-b">
                        <td class="px-6 py-4">{{ $client->prenom }} {{ $client->nom }}</td>
                        <td class="px-6 py-4">{{ $client->email }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded-full text-xs {{ $client->isActive() ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $client->isActive() ? 'Actif' : 'Inactif' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <form method="POST" action="{{ route('admin.clients.toggle-status', $client) }}">
                                @csrf
                                <button type="submit" class="px-3 py-1 text-xs rounded {{ $client->isActive() ? 'bg-red-500 text-white' : 'bg-green-500 text-white' }}">
                                    {{ $client->isActive() ? 'Désactiver' : 'Activer' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="px-6 py-3">
                {{ $clients->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
