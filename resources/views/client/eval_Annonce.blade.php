<!DOCTYPE html>
<html lang="fr">
<head>        
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Évaluation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    @include('components.sideBar')

    <style>
        .rating-star {
            font-size: 1.5rem;
            cursor: pointer;
            color: #d1d5db;
            transition: all 0.2s ease;
        }
        .rating-star.active {
            color: #f59e0b;
        }
        .vintage-box {
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            background-color: white;
        }
        .title-background {
            background-color: #f9fafb;
            border-bottom: 2px solid #e5e7eb;
            padding: 1.5rem 2rem;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">
    <div class="max-w-3xl mx-auto py-12 px-6">
        <h1 class="text-4xl font-bold text-center text-red-700 mb-12">Évaluation de votre réservation</h1>

        <form action="{{ route('evaluations.store') }}" method="POST" class="space-y-8" 
              x-data="{ 
                  submitted: false,
                  loading: false,
                  error: null,
                  annonceRating: 0,
                  partnerRating: 0
              }" 
              @submit.prevent="
                  loading = true;
                  error = null;
                  
                  const formData = new FormData($event.target);
                  formData.append('annonce_note', annonceRating);
                  formData.append('partner_note', partnerRating);

                  fetch($event.target.action, {
                      method: 'POST',
                      body: formData,
                      headers: {
                          'Accept': 'application/json',
                          'X-CSRF-TOKEN': '{{ csrf_token() }}'
                      }
                  })
                  .then(response => {
                      if (!response.ok) throw response;
                      return response.json();
                  })
                  .then(data => {
                      submitted = true;
                      setTimeout(() => {
                          window.location.href = data.redirect || '{{ route('annonces') }}';
                      }, 1500);
                  })
                  .catch(async (error) => {
                      const err = await error.json();
                      error = err.message || Object.values(err.errors).join(', ');
                  })
                  .finally(() => loading = false);
              ">
            @csrf
            <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
            <input type="hidden" name="objet_id" value="{{ $objet->id }}">
            <input type="hidden" name="partner_id" value="{{ $partner->id }}">
            <input type="hidden" name="client_id" value="{{ $reservation->client_id }}">

            <!-- Success Modal -->
            <div x-show="submitted" x-transition class="fixed inset-0 flex items-center justify-center bg-black/50 z-50">
                <div class="bg-white p-8 rounded-xl text-center max-w-md mx-4">
                    <svg class="mx-auto h-16 w-16 text-green-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Évaluation enregistrée!</h3>
                    <p class="text-gray-600">Retour à l'accueil...</p>
                </div>
            </div>

            <!-- Error Message -->
            <div x-show="error" x-transition class="p-4 mb-6 text-red-700 bg-red-100 rounded-lg border border-red-200">
                <span x-text="error"></span>
            </div>

            <!-- Loading Overlay -->
            <div x-show="loading" class="fixed inset-0 bg-black/30 z-40 flex items-center justify-center">
                <div class="animate-spin rounded-full h-12 w-12 border-4 border-white border-t-transparent"></div>
            </div>

            <!-- Jouet Evaluation -->
            <div class="vintage-box">
                <div class="title-background">
                    <h2 class="text-xl font-bold text-gray-800">Évaluation du jouet</h2>
                </div>
                <div class="p-6 space-y-6">
                    <p class="text-lg font-semibold text-gray-700">{{ $objet->nom }}</p>

                    <div class="space-y-4">
                        <div class="flex items-center gap-4">
                            <span class="text-base font-medium text-gray-600">Note:</span>
                            <div class="flex items-center gap-2">
                                <template x-for="i in 5">
                                    <button type="button" @click="annonceRating = i" 
                                            class="rating-star"
                                            :class="{ 'active': i <= annonceRating }">
                                        ★
                                    </button>
                                </template>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-base font-medium text-gray-600">Commentaire</label>
                            <textarea name="annonce_comment" rows="4" required
                                      class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-200 focus:border-red-300"
                                      placeholder="Décrivez votre expérience avec ce jouet..."></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Partenaire Evaluation -->
            <div class="vintage-box">
                <div class="title-background">
                    <h2 class="text-xl font-bold text-gray-800">Évaluation du partenaire</h2>
                </div>
                <div class="p-6 space-y-6">
                    <p class="text-lg font-semibold text-gray-700">{{ $partner->nom }}</p>

                    <div class="space-y-4">
                        <div class="flex items-center gap-4">
                            <span class="text-base font-medium text-gray-600">Note:</span>
                            <div class="flex items-center gap-2">
                                <template x-for="i in 5">
                                    <button type="button" @click="partnerRating = i" 
                                            class="rating-star"
                                            :class="{ 'active': i <= partnerRating }">
                                        ★
                                    </button>
                                </template>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-base font-medium text-gray-600">Commentaire</label>
                            <textarea name="partner_comment" rows="4" required
                                      class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-200 focus:border-red-300"
                                      placeholder="Décrivez votre expérience avec ce partenaire..."></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center pt-8">
                <button type="submit" :disabled="loading"
                        class="bg-red-600 hover:bg-red-700 text-white px-8 py-3.5 rounded-lg text-lg font-semibold transition-all
                               disabled:opacity-50 disabled:cursor-not-allowed">
                    <span x-show="!loading">Soumettre l'évaluation</span>
                    <span x-show="loading">Envoi en cours...</span>
                </button>
            </div>
        </form>
    </div>
</body>
</html>