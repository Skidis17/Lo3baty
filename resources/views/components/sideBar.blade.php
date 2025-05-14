<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lo3baty Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        @keyframes ping {
            75%, 100% { transform: scale(1.5); opacity: 0; }
        }
        .animate-ping-once { animation: ping 1s cubic-bezier(0, 0, 0.2, 1) 1; }
    </style>
</head>
<body class="font-sans bg-gray-50">
    <header class="bg-white shadow-sm sticky top-0 z-50">
        @if(session('success'))
<div 
    x-data="{ show: true }" 
    x-show="show" 
    x-transition 
    x-init="setTimeout(() => show = false, 4000)" 
    class="fixed top-5 right-5 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50"
>
    <span class="font-semibold">{{ session('success') }}</span>
    <button @click="show = false" class="ml-4 text-white hover:text-gray-100">&times;</button>
</div>
@endif

        <div class="container mx-auto px-6">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-400 bg-clip-text text-transparent">
                        Lo3baty
                    </span>
                </div>

                <nav class="hidden md:flex items-center space-x-8">
                   
                    <a href="{{ route('annonces') }}" class="relative group text-gray-600 hover:text-blue-600 transition-colors">
                        Mes annonces
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-500 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="{{ route('reservations') }}" class="relative group text-gray-600 hover:text-blue-600 transition-colors">
                        Mes réservations
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-500 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="{{ route('reclamations') }}" class="relative group text-gray-600 hover:text-blue-600 transition-colors">
                        Mes Réclamations
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-500 group-hover:w-full transition-all duration-300"></span>
                    </a>
                </nav>

                <div class="flex items-center space-x-4">
                    <!-- Icône pour les notifications d'annonces -->
                    <div class="relative">
                        <button id="annonceNotificationButton" class="p-2 rounded-full hover:bg-gray-100 transition-colors relative">
                            <i class="fas fa-bullhorn text-gray-600 text-xl"></i>
                            @php
                                $annonceNotificationsCount = auth()->user()->unreadNotifications
                                    ->whereIn('data.type', ['nouvelle_annonce', 'annonce_modifiee'])
                                    ->count();
                            @endphp
                            @if($annonceNotificationsCount > 0)
                            <span id="annonceNotificationBadge" class="absolute top-0 right-0 w-5 h-5 bg-green-500 text-white text-xs rounded-full flex items-center justify-center transform translate-x-1/2 -translate-y-1/2">
                                {{ $annonceNotificationsCount > 9 ? '9+' : $annonceNotificationsCount }}
                            </span>
                            @endif
                        </button>

                        <div id="annonceNotificationDropdown" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg z-50 border border-gray-200 divide-y divide-gray-200">
                            <div class="p-3 flex justify-between items-center bg-gray-50 rounded-t-md">
                                <h3 class="font-medium text-gray-800">Notifications d'annonces</h3>
                                <button id="markAnnonceAsRead" class="text-xs text-blue-600 hover:underline">Tout marquer comme lu</button>
                            </div>
                            
                            <div id="annonceNotificationList" class="max-h-96 overflow-y-auto">
                                @php
                                    $annonceNotifications = auth()->user()->notifications
                                        ->whereIn('data.type', ['nouvelle_annonce', 'annonce_modifiee'])
                                        ->take(10);
                                @endphp
                                @forelse($annonceNotifications as $notification)
                                    <div class="block p-3 hover:bg-gray-50 transition-colors duration-150 {{ $notification->unread() ? 'bg-green-50' : '' }}">
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0 pt-0.5">
                                                @if($notification->data['type'] == 'annonce_modifiee')
                                                    <i class="fas fa-edit text-purple-500"></i>
                                                @else
                                                    <i class="fas fa-bullhorn text-green-500"></i>
                                                @endif
                                            </div>
                                            <div class="ml-3 flex-1 min-w-0">
                                                <p class="font-medium text-gray-800">
                                                    @if($notification->data['type'] == 'annonce_modifiee')
                                                        Annonce modifiée
                                                    @else
                                                        Nouvelle annonce
                                                    @endif
                                                </p>
                                                <p class="text-sm text-gray-600 mt-1">
                                                    {{ $notification->data['message'] ?? '' }}
                                                </p>
                                                @if(isset($notification->data['titre']))
                                                    <p class="text-xs text-gray-700 mt-1 bg-gray-100 p-1 rounded">
                                                        <strong>Titre:</strong> {{ $notification->data['titre'] }}
                                                    </p>
                                                @endif
                                                <p class="text-xs text-gray-500 mt-2 flex items-center">
                                                    <i class="far fa-clock mr-1"></i>
                                                    {{ $notification->created_at->diffForHumans() }}
                                                </p>
                                                <a href="{{ $notification->data['url'] ?? '#' }}" class="mt-2 inline-block px-3 py-1 bg-blue-600 text-white text-xs rounded-full hover:bg-blue-700 transition-colors">
                                                    Détails
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="p-6 text-center text-gray-400">
                                        <i class="far fa-bell-slash text-2xl mb-2"></i>
                                        <p class="text-sm">Aucune notification d'annonce</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="relative">
                        <button id="notificationButton" class="p-2 rounded-full hover:bg-gray-100 transition-colors relative">
                            <i class="fas fa-bell text-gray-600 text-xl"></i>
                            @php
                                $otherNotificationsCount = auth()->user()->unreadNotifications
                                    ->whereNotIn('data.type', ['nouvelle_annonce', 'annonce_modifiee'])
                                    ->count();
                            @endphp
                            @if($otherNotificationsCount > 0)
                            <span id="notificationBadge" class="absolute top-0 right-0 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center transform translate-x-1/2 -translate-y-1/2">
                                {{ $otherNotificationsCount > 9 ? '9+' : $otherNotificationsCount }}
                            </span>
                            @endif
                        </button>

                        <div id="notificationDropdown" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg z-50 border border-gray-200 divide-y divide-gray-200">
                            <div class="p-3 flex justify-between items-center bg-gray-50 rounded-t-md">
                                <h3 class="font-medium text-gray-800">Notifications</h3>
                                <button id="markAllAsRead" class="text-xs text-blue-600 hover:underline">Tout marquer comme lu</button>
                            </div>
                            
                            <div id="notificationList" class="max-h-96 overflow-y-auto">
                                @php
                                    $otherNotifications = auth()->user()->notifications
                                        ->whereNotIn('data.type', ['nouvelle_annonce', 'annonce_modifiee'])
                                        ->take(10);
                                @endphp
                                @forelse($otherNotifications as $notification)
                                <div class="block p-3 hover:bg-gray-50 transition-colors duration-150 {{ $notification->unread() ? 'bg-blue-50' : '' }}"
                                   data-notification='@json($notification)'>
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 pt-0.5">
                                            @if($notification->data['type'] == 'reclamation_reponse')
                                                <i class="fas fa-reply text-blue-500"></i>
                                            @elseif($notification->data['type'] == 'reservation_expiration')
                                                <i class="fas fa-clock text-orange-500"></i>
                                            @else
                                                <i class="fas fa-bell text-gray-400"></i>
                                            @endif
                                        </div>
                                        <div class="ml-3 flex-1 min-w-0">
                                            @if($notification->data['type'] == 'reservation_expiration')
                                                <p class="font-medium text-gray-800">Réservation expirante</p>
                                                <p class="text-sm text-gray-600 mt-1">
                                                    Une de vos réservations expire bientôt
                                                </p>
                                                <p class="text-xs text-orange-600 mt-1">
                                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                                    Expire dans: {{ round(floatval(str_replace('Réservation se termine dans ', '', $notification->data['message'] ?? '0'))) }}h
                                                </p>
                                                <a href="{{ route('reservations') }}" class="mt-2 inline-block px-3 py-1 bg-blue-600 text-white text-xs rounded-full hover:bg-blue-700 transition-colors">
                                                Détails
                                            </a>
                                            @else
                                                <p class="font-medium text-gray-800">
                                                    @if($notification->data['type'] == 'reclamation_reponse')
                                                        Réponse à votre réclamation
                                                    @else
                                                        Notification
                                                    @endif
                                                </p>
                                               
                                                @if($notification->data['type'] == 'reclamation_reponse')
                                                    <p class="text-xs text-gray-700 mt-1 bg-gray-100 p-1 rounded">
                                                        <strong>Sujet:</strong> {{ $notification->data['sujet'] ?? '' }}
                                                    </p>

                                                    <a href="client/reclamations" class="mt-2 inline-block px-3 py-1 bg-blue-600 text-white text-xs rounded-full hover:bg-blue-700 transition-colors">
                                                Détails
                                            </a>
                                                @endif
                                            @endif
                                            
                                            <p class="text-xs text-gray-500 mt-2 flex items-center">
                                                <i class="far fa-clock mr-1"></i>
                                                {{ $notification->created_at->diffForHumans() }}
                                            </p>
                                            
                                        </div>
                                    </div>
                                </div>
                                @empty
                                    <div class="p-6 text-center text-gray-400">
                                        <i class="far fa-bell-slash text-2xl mb-2"></i>
                                        <p class="text-sm">Aucune notification disponible</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="relative inline-block text-left" x-data="{ open: false }" @click.away="open = false">
    <button @click="open = !open" class="w-9 h-9 rounded-full bg-gradient-to-r from-blue-400 to-blue-600 flex items-center justify-center text-white hover:opacity-90 transition focus:outline-none">
        <i class="fas fa-user text-sm"></i>
    </button>

    <!-- Menu déroulant -->
    <div x-show="open" x-transition class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
        <a href="{{ route('parametres') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Paramètres</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Déconnexion</button>
        </form>
    </div>
</div>

                </div>
            </div>
        </div>
    </header>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        
        const annonceNotificationButton = document.getElementById('annonceNotificationButton');
        const annonceNotificationDropdown = document.getElementById('annonceNotificationDropdown');
        const annonceNotificationList = document.getElementById('annonceNotificationList');
        const markAnnonceAsRead = document.getElementById('markAnnonceAsRead');
        let annonceNotificationBadge = document.getElementById('annonceNotificationBadge');

        
        const notificationButton = document.getElementById('notificationButton');
        const notificationDropdown = document.getElementById('notificationDropdown');
        const notificationList = document.getElementById('notificationList');
        const markAllAsRead = document.getElementById('markAllAsRead');
        let notificationBadge = document.getElementById('notificationBadge');

        function formatExpirationMessage(message) {
            const hours = parseFloat(message.replace('Réservation se termine dans ', '').replace('h', ''));
            return Math.round(hours) + 'h';
        }

        function renderAnnonceNotifications(notifications) {
            if (notifications.length === 0) {
                annonceNotificationList.innerHTML = `
                    <div class="p-6 text-center text-gray-400">
                        <i class="far fa-bell-slash text-2xl mb-2"></i>
                        <p class="text-sm">Aucune notification d'annonce</p>
                    </div>
                `;
                return;
            }

            annonceNotificationList.innerHTML = notifications.map(notif => `
                <div class="block p-3 hover:bg-gray-50 transition-colors duration-150 ${notif.read_at ? '' : 'bg-green-50'}">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 pt-0.5">
                            ${notif.data.type === 'annonce_modifiee' ? 
                                '<i class="fas fa-edit text-purple-500"></i>' : 
                                '<i class="fas fa-bullhorn text-green-500"></i>'}
                        </div>
                        <div class="ml-3 flex-1 min-w-0">
                            <p class="font-medium text-gray-800">
                                ${notif.data.type === 'annonce_modifiee' ? 'Annonce modifiée' : 'Nouvelle annonce'}
                            </p>
                            <p class="text-sm text-gray-600 mt-1">
                                ${notif.data.message || ''}
                            </p>
                            ${notif.data.titre ? `
                                <p class="text-xs text-gray-700 mt-1 bg-gray-100 p-1 rounded">
                                    <strong>Titre:</strong> ${notif.data.titre}
                                </p>
                            ` : ''}
                            <p class="text-xs text-gray-500 mt-2 flex items-center">
                                <i class="far fa-clock mr-1"></i>
                                ${new Date(notif.created_at).toLocaleString('fr-FR', { 
                                    day: 'numeric', 
                                    month: 'short', 
                                    year: 'numeric',
                                    hour: '2-digit',
                                    minute: '2-digit'
                                })}
                            </p>
                            <a href="${notif.data.url || '#'}" class="mt-2 inline-block px-3 py-1 bg-blue-600 text-white text-xs rounded-full hover:bg-blue-700 transition-colors">
                                Détails
                            </a>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        function renderNotifications(notifications) {
            if (notifications.length === 0) {
                notificationList.innerHTML = `
                    <div class="p-6 text-center text-gray-400">
                        <i class="far fa-bell-slash text-2xl mb-2"></i>
                        <p class="text-sm">Aucune notification disponible</p>
                    </div>
                `;
                return;
            }

            notificationList.innerHTML = notifications.map(notif => {
                const isReclamation = notif.data.type === 'reclamation_reponse';
                const isReservation = notif.data.type === 'reservation_expiration';
                
                if (isReclamation) {
                    return `
                        <div class="block p-3 hover:bg-gray-50 transition-colors duration-150 ${notif.read_at ? '' : 'bg-blue-50'}">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 pt-0.5">
                                    <i class="fas fa-reply text-blue-500"></i>
                                </div>
                                <div class="ml-3 flex-1 min-w-0">
                                    <p class="font-medium text-gray-800">
                                        Réponse à votre réclamation
                                    </p>
                                    <p class="text-sm text-gray-600 mt-1">
                                        ${notif.data.message || ''}
                                    </p>
                                    <p class="text-xs text-gray-700 mt-1 bg-gray-100 p-1 rounded">
                                        <strong>Sujet:</strong> ${notif.data.sujet || ''}
                                    </p>
                                    <p class="text-xs text-gray-500 mt-2 flex items-center">
                                        <i class="far fa-clock mr-1"></i>
                                        ${new Date(notif.created_at).toLocaleString('fr-FR', { 
                                            day: 'numeric', 
                                            month: 'short', 
                                            year: 'numeric',
                                            hour: '2-digit',
                                            minute: '2-digit'
                                        })}
                                    </p>
                                    <a href="${notif.data.url || '#'}" class="mt-2 inline-block px-3 py-1 bg-blue-600 text-white text-xs rounded-full hover:bg-blue-700 transition-colors">
                                        Détails
                                    </a>
                                </div>
                            </div>
                        </div>
                    `;
                } else if (isReservation) {
                    return `
                        <div class="block p-3 hover:bg-gray-50 transition-colors duration-150 ${notif.read_at ? '' : 'bg-blue-50'}">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 pt-0.5">
                                    <i class="fas fa-clock text-orange-500"></i>
                                </div>
                                <div class="ml-3 flex-1 min-w-0">
                                    <p class="font-medium text-gray-800">Réservation expirante</p>
                                    <p class="text-sm text-gray-600 mt-1">
                                        Votre réservation #${notif.data.reservation_id || ''} expire bientôt
                                    </p>
                                    <p class="text-xs text-orange-600 mt-1">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        Expire dans: ${formatExpirationMessage(notif.data.message || '0h')}
                                    </p>
                                    <p class="text-xs text-gray-500 mt-2 flex items-center">
                                        <i class="far fa-clock mr-1"></i>
                                        ${new Date(notif.created_at).toLocaleString('fr-FR', { 
                                            day: 'numeric', 
                                            month: 'short', 
                                            year: 'numeric',
                                            hour: '2-digit',
                                            minute: '2-digit'
                                        })}
                                    </p>
                                    <a href="${notif.data.url || '#'}" class="mt-2 inline-block px-3 py-1 bg-blue-600 text-white text-xs rounded-full hover:bg-blue-700 transition-colors">
                                        Détails
                                    </a>
                                </div>
                            </div>
                        </div>
                    `;
                } else {
                    return `
                        <div class="block p-3 hover:bg-gray-50 transition-colors duration-150 ${notif.read_at ? '' : 'bg-blue-50'}">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 pt-0.5">
                                    <i class="fas fa-bell text-gray-400"></i>
                                </div>
                                <div class="ml-3 flex-1 min-w-0">
                                    <p class="font-medium text-gray-800">
                                        Notification
                                    </p>
                                    <p class="text-sm text-gray-600 mt-1">
                                        ${notif.data.message || ''}
                                    </p>
                                    <p class="text-xs text-gray-500 mt-2 flex items-center">
                                        <i class="far fa-clock mr-1"></i>
                                        ${new Date(notif.created_at).toLocaleString('fr-FR', { 
                                            day: 'numeric', 
                                            month: 'short', 
                                            year: 'numeric',
                                            hour: '2-digit',
                                            minute: '2-digit'
                                        })}
                                    </p>
                                    <a href="${notif.data.url || '#'}" class="mt-2 inline-block px-3 py-1 bg-blue-600 text-white text-xs rounded-full hover:bg-blue-700 transition-colors">
                                        Détails
                                    </a>
                                </div>
                            </div>
                        </div>
                    `;
                }
            }).join('');
        }

        function updateAnnonceNotificationBadge() {
            fetch('/client/notifications/unread-count?type=annonce')
                .then(response => response.json())
                .then(data => {
                    const count = data.count;
                    if (count > 0) {
                        if (!annonceNotificationBadge) {
                            annonceNotificationBadge = document.createElement('span');
                            annonceNotificationBadge.id = 'annonceNotificationBadge';
                            annonceNotificationBadge.className = 'absolute top-0 right-0 w-5 h-5 bg-green-500 text-white text-xs rounded-full flex items-center justify-center transform translate-x-1/2 -translate-y-1/2 animate-ping-once';
                            annonceNotificationButton.appendChild(annonceNotificationBadge);
                        }
                        annonceNotificationBadge.textContent = count > 9 ? '9+' : count;
                        annonceNotificationBadge.classList.add('animate-ping-once');
                        setTimeout(() => annonceNotificationBadge.classList.remove('animate-ping-once'), 1000);
                    } else if (annonceNotificationBadge) {
                        annonceNotificationBadge.remove();
                        annonceNotificationBadge = null;
                    }
                });
        }

        function updateNotificationBadge() {
            fetch('/client/notifications/unread-count?type=other')
                .then(response => response.json())
                .then(data => {
                    const count = data.count;
                    if (count > 0) {
                        if (!notificationBadge) {
                            notificationBadge = document.createElement('span');
                            notificationBadge.id = 'notificationBadge';
                            notificationBadge.className = 'absolute top-0 right-0 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center transform translate-x-1/2 -translate-y-1/2 animate-ping-once';
                            notificationButton.appendChild(notificationBadge);
                        }
                        notificationBadge.textContent = count > 9 ? '9+' : count;
                        notificationBadge.classList.add('animate-ping-once');
                        setTimeout(() => notificationBadge.classList.remove('animate-ping-once'), 1000);
                    } else if (notificationBadge) {
                        notificationBadge.remove();
                        notificationBadge = null;
                    }
                });
        }

        function loadAnnonceNotifications() {
            fetch('/client/notifications/latest?type=annonce')
                .then(response => response.json())
                .then(data => {
                    renderAnnonceNotifications(data);
                    updateAnnonceNotificationBadge();
                });
        }

        function loadNotifications() {
            fetch('/client/notifications/latest?type=other')
                .then(response => response.json())
                .then(data => {
                    renderNotifications(data);
                    updateNotificationBadge();
                });
        }

        document.addEventListener('click', function() {
            annonceNotificationDropdown.classList.add('hidden');
            notificationDropdown.classList.add('hidden');
        });

        annonceNotificationDropdown?.addEventListener('click', function(e) {
            e.stopPropagation();
        });

        notificationDropdown?.addEventListener('click', function(e) {
            e.stopPropagation();
        });

        if (markAnnonceAsRead) {
            markAnnonceAsRead.addEventListener('click', function(e) {
                e.preventDefault();
                fetch('/client/notifications/mark-as-read?type=annonce', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json'
                    }
                }).then(() => {
                    document.querySelectorAll('#annonceNotificationList .bg-green-50').forEach(el => {
                        el.classList.remove('bg-green-50');
                    });
                    updateAnnonceNotificationBadge();
                });
            });
        }

        if (markAllAsRead) {
            markAllAsRead.addEventListener('click', function(e) {
                e.preventDefault();
                fetch('/client/notifications/mark-as-read?type=other', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json'
                    }
                }).then(() => {
                    document.querySelectorAll('#notificationList .bg-blue-50').forEach(el => {
                        el.classList.remove('bg-blue-50');
                    });
                    updateNotificationBadge();
                });
            });
        }

        if (annonceNotificationButton) {
            annonceNotificationButton.addEventListener('click', function(e) {
                e.stopPropagation();
                annonceNotificationDropdown.classList.toggle('hidden');
                notificationDropdown.classList.add('hidden');
                loadAnnonceNotifications();
            });
        }

        if (notificationButton) {
            notificationButton.addEventListener('click', function(e) {
                e.stopPropagation();
                notificationDropdown.classList.toggle('hidden');
                annonceNotificationDropdown.classList.add('hidden');
                loadNotifications();
            });
        }

        updateAnnonceNotificationBadge();
        updateNotificationBadge();

        setInterval(updateAnnonceNotificationBadge, 30000);
        setInterval(updateNotificationBadge, 30000);
    });
    </script>
</body>
</html>