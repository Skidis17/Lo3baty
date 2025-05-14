@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md mx-auto">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="px-6 py-4 bg-indigo-600 text-white">
            <h2 class="text-xl font-semibold">Tableau de Bord client</h2>
            </div>
            
            <div class="p-6">
                @if (session('status'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                        {{ session('status') }}
                    </div>
                @endif

                <p class="mb-6 text-gray-700">Bienvenue, {{ Auth::user()->name }} !</p>

        </div>
    </div>
</div>
@endsection
