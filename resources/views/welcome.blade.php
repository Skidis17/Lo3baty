<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lo3baty - Location de jeux</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50">
  <!-- Navigation -->
  <nav class="bg-white shadow-md">
    <div class="container mx-auto px-4 flex items-center justify-between" style="height: 100px;">
      <!-- Adjusted height -->
      <a href="/" class="text-2xl font-bold flex items-center hover:text-indigo-600 transition duration-300">
        <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="Lo3baty" class="h-35">
        <!-- Adjusted logo height -->
      </a>

      <div class="hidden md:flex space-x-6">
        <a href="#hero" class="hover:text-indigo-600 font-medium transition duration-300">Accueil</a>
        <a href="#featured-games" class="hover:text-indigo-600 font-medium transition duration-300">Jeux</a>
        <a href="#how-it-works" class="hover:text-indigo-600 font-medium transition duration-300">Comment ça marche</a>
        <a href="#contact" class="hover:text-indigo-600 font-medium transition duration-300">Contact</a>
      </div>

      <div class="flex items-center space-x-4">
        <a href="#" class="hover:text-indigo-600 transition duration-300">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
          </svg>
        </a>
        <a href="#" class="bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-md font-medium transition duration-300">Connexion</a>
      </div>

      <button class="md:hidden focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
    </div>
  </nav>

  <!-- Hero Section -->
  <section id="hero" class="relative py-24 text-white" style="background-color: #f0f4ff;">
    <!-- Light Blue Background -->
    <div class="absolute inset-0 bg-black opacity-60 z-0"></div>
    <!-- Increased opacity -->
    <div class="absolute inset-0 z-0">
      <img src="https://cdn.svc.asmodee.net/production-asmodeefrblog/uploads/2022/03/AVE-enfants-jeux-de-societe-asmodee-blog.jpg"
        alt="Jeux vidéo" class="w-full h-full object-cover">
    </div>

    <div class="container mx-auto px-4 flex flex-col md:flex-row items-center justify-center relative z-10"
      style="min-height: 60vh;">
      <!-- Added justify-center and min-height -->
      <div class="md:w-1/2 mb-8 md:mb-0 text-center">
        <!-- Added text-center -->
        <h1 class="text-4xl md:text-5xl font-bold mb-6 text-indigo-500" style="text-shadow: 2px 2px 4px #000000;">Louez
          vos jeux préférés facilement</h1>
        <!-- Added text shadow -->
        <div class="relative inline-block">
          <p class="text-xl mb-8 text-white relative z-10" style="text-shadow: 1px 1px 2px #000000;">Découvrez notre vaste collection
            de jeux pour toutes les plateformes à des prix imbattables.</p>
          <div class="absolute inset-0 bg-gray-400 opacity-20 blur-lg -z-10"></div>
        </div>
        <!-- Added text shadow -->
        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 justify-center">
          <!-- Added justify-center -->
          <a href="#featured-games"
            class="bg-indigo-600 hover:bg-indigo-500 text-white px-8 py-4 rounded-md font-bold text-center transition duration-300">Explorer
            les jeux</a>
          <a href="#how-it-works"
            class="border-2 border-indigo-600 text-indigo-600 hover:bg-indigo-100 px-8 py-4 rounded-md font-bold text-center transition duration-300">Comment
            ça marche</a>
        </div>
      </div>

    </div>
  </section>

  <!-- Featured Games -->
  <section id="featured-games" class="py-24 bg-gray-50">
    <div class="container mx-auto px-4">
      <h2 class="text-3xl font-bold text-center mb-16 text-gray-800">Jeux populaires</h2>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12">
        <!-- Game Card 1 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
          <img src="https://www.allobebe.ma/wp-content/uploads/2021/02/poupee_chiffon.png" alt="Jeu 1"
            class="w-full h-64 object-cover">
          <div class="p-6">
            <h3 class="font-bold text-xl mb-4 text-gray-800">Nom du Jeu 1</h3>
            <p class="text-gray-600 mb-6">Plateforme: poupée</p>
            <div class="flex justify-between items-center">
              <span class="font-bold text-indigo-600">15€/semaine</span>
              <button
                class="bg-indigo-600 hover:bg-indigo-500 text-white px-6 py-3 rounded-md transition duration-300">Louer</button>
            </div>
          </div>
        </div>

        <!-- Game Card 2 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
          <img src="https://i.ebayimg.com/images/g/6YcAAOSwEcRkkC1L/s-l1200.jpg" alt="Jeu 2"
            class="w-full h-64 object-cover">
          <div class="p-6">
            <h3 class="font-bold text-xl mb-4 text-gray-800">Nom du Jeu 2</h3>
            <p class="text-gray-600 mb-6">Plateforme: voiture jouet</p>
            <div class="flex justify-between items-center">
              <span class="font-bold text-indigo-600">12€/semaine</span>
              <button
                class="bg-indigo-600 hover:bg-indigo-500 text-white px-6 py-3 rounded-md transition duration-300">Louer</button>
            </div>
          </div>
        </div>

        <!-- Game Card 3 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
          <img src="https://www.nintendo.com/eu/media/images/08_content_images/systems_5/nintendo_switch_3/not_approved_1/TEMP_img_01.jpg"
            alt="Jeu 3" class="w-full h-64 object-cover">
          <div class="p-6">
            <h3 class="font-bold text-xl mb-4 text-gray-800">Nom du Jeu 3</h3>
            <p class="text-gray-600 mb-6">Plateforme: Nintendo Switch</p>
            <div class="flex justify-between items-center">
              <span class="font-bold text-indigo-600">10€/semaine</span>
              <button
                class="bg-indigo-600 hover:bg-indigo-500 text-white px-6 py-3 rounded-md transition duration-300">Louer</button>
            </div>
          </div>
        </div>

        <!-- Game Card 4 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
          <img src="https://images.tokopedia.net/img/cache/700/VqbcmM/2023/3/4/c5f2c39c-ae60-4944-8f2f-2eb53bafbef1.jpg"
            alt="Jeu 4" class="w-full h-64 object-cover">
          <div class="p-6">
            <h3 class="font-bold text-xl mb-4 text-gray-800">Nom du Jeu 4</h3>
            <p class="text-gray-600 mb-6">Plateforme: PC</p>
            <div class="flex justify-between items-center">
              <span class="font-bold text-indigo-600">8€/semaine</span>
              <button
                class="bg-indigo-600 hover:bg-indigo-500 text-white px-6 py-3 rounded-md transition duration-300">Louer</button>
            </div>
          </div>
        </div>
      </div>

      <div class="text-center mt-16">
        <a href="#"
          class="inline-block bg-indigo-600 hover:bg-indigo-500 text-white px-8 py-4 rounded-md font-bold transition duration-300">Voir
          tous les jeux</a>
      </div>
    </div>
  </section>

  <!-- How It Works -->
  <section id="how-it-works" class="py-24 bg-white">
    <div class="container mx-auto px-4">
      <h2 class="text-3xl font-bold text-center mb-16 text-gray-800">Comment ça marche</h2>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
        <!-- Step 1 -->
        <div class="bg-gray-50 p-8 rounded-lg shadow-md text-center hover:shadow-xl transition duration-300">
          <div class="bg-indigo-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
            <span class="text-indigo-600 text-3xl font-bold">1</span>
          </div>
          <h3 class="font-bold text-xl mb-4 text-gray-800">Choisissez votre jeu</h3>
          <p class="text-gray-600">Parcourez notre catalogue et sélectionnez le jeu que vous souhaitez louer.</p>
        </div>

        <!-- Step 2 -->
        <div class="bg-gray-50 p-8 rounded-lg shadow-md text-center hover:shadow-xl transition duration-300">
          <div class="bg-indigo-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
            <span class="text-indigo-600 text-3xl font-bold">2</span>
          </div>
          <h3 class="font-bold text-xl mb-4 text-gray-800">Passez commande</h3>
          <p class="text-gray-600">Sélectionnez la durée de location et finalisez votre commande.</p>
        </div>

        <!-- Step 3 -->
        <div class="bg-gray-50 p-8 rounded-lg shadow-md text-center hover:shadow-xl transition duration-300">
          <div class="bg-indigo-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
            <span class="text-indigo-600 text-3xl font-bold">3</span>
          </div>
          <h3 class="font-bold text-xl mb-4 text-gray-800">Recevez et jouez</h3>
          <p class="text-gray-600">Nous vous livrons le jeu et vous pouvez profiter de votre expérience gaming.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonials -->
  <section class="py-24 bg-gray-50">
    <div class="container mx-auto px-4">
      <h2 class="text-3xl font-bold text-center mb-16 text-gray-800">Ce que disent nos clients</h2>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
        <!-- Testimonial 1 -->
        <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300">
          <div class="flex items-center mb-6">
            <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mr-6">
              <span class="text-indigo-600 font-bold text-lg">JD</span>
            </div>
            <div>
              <h4 class="font-bold text-lg text-gray-800">Jean Dupont</h4>
              <div class="flex text-yellow-400">
                ★ ★ ★ ★ ★
              </div>
            </div>
          </div>
          <p class="text-gray-600">"Service excellent et rapide. J'ai pu jouer à la dernière sortie sans avoir à payer le
            prix fort. Je recommande!"</p>
        </div>

        <!-- Testimonial 2 -->
        <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300">
          <div class="flex items-center mb-6">
            <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mr-6">
              <span class="text-indigo-600 font-bold text-lg">SM</span>
            </div>
            <div>
              <h4 class="font-bold text-lg text-gray-800">Sarah Martin</h4>
              <div class="flex text-yellow-400">
                ★ ★ ★ ★ ☆
              </div>
            </div>
          </div>
          <p class="text-gray-600">"Très satisfaite de mon expérience. Le jeu était en parfait état et la livraison a été
            plus rapide que prévue."</p>
        </div>

        <!-- Testimonial 3 -->
        <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300">
          <div class="flex items-center mb-6">
            <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mr-6">
              <span class="text-indigo-600 font-bold text-lg">TP</span>
            </div>
            <div>
              <h4 class="font-bold text-lg text-gray-800">Thomas Petit</h4>
              <div class="flex text-yellow-400">
                ★ ★ ★ ★ ★
              </div>
            </div>
          </div>
          <p class="text-gray-600">"Je loue régulièrement chez Lo3baty. Leur catalogue est vaste et leurs prix sont
            imbattables. 10/10!"</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Newsletter -->
  <section class="py-24" style="background-color: #f0f4ff;">
    <!-- Light Blue Background -->
    <div class="container mx-auto px-4 text-center">
      <h2 class="text-3xl font-bold mb-8 text-gray-800">Restez informé</h2>
      <p class="text-xl mb-12 max-w-2xl mx-auto text-gray-700">Abonnez-vous à notre newsletter pour recevoir les
        dernières nouveautés et offres spéciales.</p>

      <form class="max-w-md mx-auto flex">
        <input type="email" placeholder="Votre email"
          class="flex-grow px-6 py-4 rounded-l-md focus:outline-none text-gray-900">
        <button type="submit"
          class="bg-indigo-600 hover:bg-indigo-500 text-white px-8 py-4 rounded-r-md font-bold transition duration-300">S'abonner</button>
      </form>
    </div>
  </section>

  <!-- Footer -->
  <footer id="contact" class="bg-gray-800 text-white py-12">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <!-- About -->
        <div>
          <h3 class="text-xl font-bold mb-4 flex items-center hover:text-indigo-200 transition duration-300">
            <a href="/" class="text-2xl font-bold flex items-center hover:text-indigo-200 transition duration-300">
              <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="Lo3baty" class="h-30">
            </a>
          </h3>
          <p class="text-gray-400">Votre plateforme de location de jeux préférée. </p>
          <p class="text-gray-400">Des prix imbattables pour des heures de jeu inoubliables.</p>
        </div>

        <!-- Links -->
        <div>
          <h3 class="text-lg font-bold mb-4">Liens utiles</h3>
          <ul class="space-y-2">
            <li><a href="#hero" class="text-gray-400 hover:text-white transition duration-300">Accueil</a></li>
            <li><a href="#featured-games" class="text-gray-400 hover:text-white transition duration-300">Jeux</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">FAQ</a></li>
            <li><a href="#contact" class="text-gray-400 hover:text-white transition duration-300">Contact</a></li>
          </ul>
        </div>

        <!-- Legal -->
        <div>
          <h3 class="text-lg font-bold mb-4">Informations légales</h3>
          <ul class="space-y-2">
            <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">CGV</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Mentions légales</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Politique de confidentialité</a></li>
          </ul>
        </div>

        <!-- Contact -->
        <div>
          <h3 class="text-lg font-bold mb-4">Contactez-nous</h3>
          <ul class="space-y-2 text-gray-400">
            <li class="flex items-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
              </svg>
              +212 6 12 34 56 78
            </li>
            <li class="flex items-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
              </svg>
              contact@lo3baty.com
            </li>
          </ul>

          <div class="flex space-x-4 mt-4">
            <a href="#" class="text-gray-400 hover:text-white transition duration-300">
              <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path fill-rule="evenodd"
                  d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                  clip-rule="evenodd" />
              </svg>
            </a>
            <a href="#" class="text-gray-400 hover:text-white transition duration-300">
              <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path
                  d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
              </svg>
            </a>
            <a href="#" class="text-gray-400 hover:text-white transition duration-300">
              <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path fill-rule="evenodd"
                  d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.772 1.153 4.902 4.902 0 01-1.153 1.772c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153 1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                  clip-rule="evenodd" />
              </svg>
            </a>
          </div>
        </div>
      </div>

      <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
        <p>&copy; 2023 Lo3baty. Tous droits réservés.</p>
      </div>
    </div>
  </footer>
</body>

</html>
