@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
            {{ __('Inscription') }}
        </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <form class="space-y-6" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf

                <div>
                    <label for="nom" class="block text-sm font-medium text-gray-700">{{ __('Nom') }}</label>
                    <div class="mt-1">
                        <input id="nom" name="nom" type="text" autocomplete="nom" required
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('nom') border-red-500 @enderror"
                               value="{{ old('nom') }}">
                        @error('nom')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="prenom" class="block text-sm font-medium text-gray-700">{{ __('Prénom') }}</label>
                    <div class="mt-1">
                        <input id="prenom" name="prenom" type="text" autocomplete="prenom" required
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('prenom') border-red-500 @enderror"
                               value="{{ old('prenom') }}">
                        @error('prenom')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" autocomplete="email" required
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('email') border-red-500 @enderror"
                               value="{{ old('email') }}">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="mot_de_passe" class="block text-sm font-medium text-gray-700">{{ __('Mot de passe') }}</label>
                    <div class="mt-1">
                        <input id="mot_de_passe" name="mot_de_passe" type="password" autocomplete="new-password" required
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('mot_de_passe') border-red-500 @enderror">
                        @error('mot_de_passe')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="mot_de_passe-confirm" class="block text-sm font-medium text-gray-700">{{ __('Confirmer le mot de passe') }}</label>
                    <div class="mt-1">
                        <input id="mot_de_passe-confirm" name="mot_de_passe_confirmation" type="password" autocomplete="new-password" required
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>

                <div>
                    <label for="image_profil" class="block text-sm font-medium text-gray-700">{{ __('Image de profil') }}</label>
                    <div class="mt-1">
                        <input id="image_profil" name="image_profil" type="file"
                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 @error('image_profil') border-red-500 @enderror">
                        @error('image_profil')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('S\'inscrire') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
