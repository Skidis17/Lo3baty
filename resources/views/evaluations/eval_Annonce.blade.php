<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Évaluation</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        .rating-star { 
            cursor: pointer;
            transition: color 0.2s;
            color: #e2e8f0;
            font-size: 2rem;
        }
        .rating-star.active { color: #f59e0b; }
        .form-section { margin-bottom: 2.5rem; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen p-6">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-xl shadow-md p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-8">Évaluation de votre réservation</h1>

            <form action="{{ route('evaluations.store') }}" method="POST" class="space-y-8">
                @csrf
                <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                <input type="hidden" name="objet_id" value="{{ $objet->id }}">
                <input type="hidden" name="partner_id" value="{{ $partner->id }}">
                <input type="hidden" name="client_id" value="{{ $reservation->client_id }}">

                <!-- Annonce Evaluation -->
                <div class="form-section">
                    <h2 class="text-xl font-semibold mb-4">Évaluation du jouet</h2>
                    <p class="text-gray-600 mb-4">{{ $objet->nom }}</p>
                    
                    <div x-data="{ rating: 0 }" class="mb-4">
                        <div class="flex gap-2">
                            <template x-for="i in 5">
                                <button type="button" @click="rating = i" class="rating-star"
                                    :class="{ 'active': i <= rating }">
                                    ★
                                </button>
                            </template>
                        </div>
                        <input type="hidden" name="annonce_note" x-model="rating" required>
                    </div>

                    <div>
                        <label class="block text-gray-700 mb-2">Commentaire sur le jouet</label>
                        <textarea name="annonce_comment" 
                                  class="w-full p-2 border rounded"
                                  rows="3"
                                  required></textarea>
                    </div>
                </div>

                <!-- Partner Evaluation -->
                <div class="form-section">
                    <h2 class="text-xl font-semibold mb-4">Évaluation du partenaire</h2>
                    <p class="text-gray-600 mb-4">{{ $partner->nom }}</p>
                    
                    <div x-data="{ rating: 0 }" class="mb-4">
                        <div class="flex gap-2">
                            <template x-for="i in 5">
                                <button type="button" @click="rating = i" class="rating-star"
                                    :class="{ 'active': i <= rating }">
                                    ★
                                </button>
                            </template>
                        </div>
                        <input type="hidden" name="partner_note" x-model="rating" required>
                    </div>

                    <div>
                        <label class="block text-gray-700 mb-2">Commentaire sur le partenaire</label>
                        <textarea name="partner_comment" 
                                  class="w-full p-2 border rounded"
                                  rows="3"
                                  required></textarea>
                    </div>
                </div>

                <button type="submit" 
                        class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                    Soumettre les évaluations
                </button>
            </form>
        </div>
    </div>
</body>
</html>
