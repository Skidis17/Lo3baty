<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Évaluer l'annonce</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Nunito', sans-serif; background-color: #f8fafc; }
        .rating-star { color: #e2e8f0; cursor: pointer; transition: color 0.2s; }
        .rating-star.active { color: #f59e0b; }
    </style>
</head>
<body class="min-h-screen bg-gray-100">
    @include('components.navbar')

    <div class="max-w-md mx-auto p-6">
        <div class="bg-white rounded-xl shadow-md p-8">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Évaluer votre expérience</h1>
            
            <form action="{{ route('evaluations.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <input type="hidden" name="objet_id" value="{{ $annonce->objet->id }}">
                <input type="hidden" name="client_id" value="{{ auth()->id() }}">

                <div>
                    <label class="block text-gray-700 font-medium mb-2">Note</label>
                    <div class="flex space-x-2" x-data="{ rating: 0, hoverRating: 0 }">
                        <template x-for="i in 5">
                            <svg @click="rating = i" 
                                 @mouseover="hoverRating = i" 
                                 @mouseleave="hoverRating = 0"
                                 :class="{ 'active': (hoverRating || rating) >= i }"
                                 class="w-8 h-8 rating-star" 
                                 fill="currentColor" 
                                 viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </template>
                        <input type="hidden" name="note" x-model="rating" required>
                    </div>
                    @error('note')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="commentaire" class="block text-gray-700 font-medium mb-2">Commentaire</label>
                    <textarea name="commentaire" id="commentaire" rows="4"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Dites-nous ce que vous avez pensé de cette annonce..."
                        required></textarea>
                    @error('commentaire')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                        Soumettre l'évaluation
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>