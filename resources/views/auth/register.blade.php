@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-r from-indigo-50 via-white to-indigo-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-2xl shadow-xl border border-gray-100">
        <div>
            <h2 class="text-center text-3xl font-bold text-gray-800 tracking-tight">
                {{ __('Créer un compte') }}
            </h2>
        </div>

        <form class="space-y-5" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <!-- Nom -->
            <div>
                <label for="nom" class="block text-sm font-medium text-gray-700">{{ __('Nom') }}</label>
                <input id="nom" name="nom" type="text" required autocomplete="nom"
                    class="mt-1 block w-full rounded-xl border border-gray-300 px-4 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('nom') border-red-500 @enderror"
                    value="{{ old('nom') }}">
                @error('nom')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Prénom -->
            <div>
                <label for="prenom" class="block text-sm font-medium text-gray-700">{{ __('Prénom') }}</label>
                <input id="prenom" name="prenom" type="text" required autocomplete="prenom"
                    class="mt-1 block w-full rounded-xl border border-gray-300 px-4 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('prenom') border-red-500 @enderror"
                    value="{{ old('prenom') }}">
                @error('prenom')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Surnom -->
            <div>
                <label for="surnom" class="block text-sm font-medium text-gray-700">{{ __('Surnom') }}</label>
                <input id="surnom" name="surnom" type="text" required autocomplete="surnom"
                    class="mt-1 block w-full rounded-xl border border-gray-300 px-4 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('surnom') border-red-500 @enderror"
                    value="{{ old('surnom') }}">
                @error('surnom')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
                <input id="email" name="email" type="email" required autocomplete="email"
                    class="mt-1 block w-full rounded-xl border border-gray-300 px-4 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('email') border-red-500 @enderror"
                    value="{{ old('email') }}">
                @error('email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Mot de passe -->
            <div>
                <label for="mot_de_passe" class="block text-sm font-medium text-gray-700">{{ __('Mot de passe') }}</label>
                <input id="mot_de_passe" name="mot_de_passe" type="password" required autocomplete="new-password"
                    class="mt-1 block w-full rounded-xl border border-gray-300 px-4 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('mot_de_passe') border-red-500 @enderror">
                @error('mot_de_passe')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirmation mot de passe -->
            <div>
                <label for="mot_de_passe-confirm" class="block text-sm font-medium text-gray-700">{{ __('Confirmer le mot de passe') }}</label>
                <input id="mot_de_passe-confirm" name="mot_de_passe_confirmation" type="password" required autocomplete="new-password"
                    class="mt-1 block w-full rounded-xl border border-gray-300 px-4 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <!-- Image de profil -->
            <div>
                <label for="image_profil" class="block text-sm font-medium text-gray-700">{{ __('Image de profil') }}</label>
                <input id="image_profil" name="image_profil" type="file"
                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 @error('image_profil') border-red-500 @enderror">
                @error('image_profil')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit -->
            <div>
                <button type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                    {{ __('S\'inscrire') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
