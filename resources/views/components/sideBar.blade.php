<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lo3baty Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
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
        <div class="container mx-auto px-6">
            <div class="flex items-center justify-between h-16">
                
                <div class="flex items-center">
                    <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-400 bg-clip-text text-transparent">
                        Lo3baty
                    </span>
                </div>

                <nav class="hidden md:flex items-center space-x-8">
                    <a href="#" class="relative group text-gray-600 hover:text-blue-600 transition-colors">
                        Accueil
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-500 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="#" class="relative group text-gray-600 hover:text-blue-600 transition-colors">
                        Mes annonces
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-500 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="#" class="relative group text-gray-600 hover:text-blue-600 transition-colors">
                        Mes réservations
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-500 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="{{ route('client.reclamations') }}" class="relative group text-gray-600 hover:text-blue-600 transition-colors">
                        Réclamations
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-500 group-hover:w-full transition-all duration-300"></span>
                    </a>
                </nav>

                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <button id="notificationButton" class="p-2 rounded-full hover:bg-gray-100 transition-colors relative">
                            <i class="fas fa-bell text-gray-600 text-xl"></i>
                            @if(auth()->user()->unreadNotifications->count() > 0)
                            <span id="notificationBadge" class="absolute top-0 right-0 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center transform translate-x-1/2 -translate-y-1/2">
                                {{ auth()->user()->unreadNotifications->count() > 9 ? '9+' : auth()->user()->unreadNotifications->count() }}
                            </span>
                            @endif
                        </button>

                        <div id="notificationDropdown" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg z-50 border border-gray-200 divide-y divide-gray-200">
                            <div class="p-3 flex justify-between items-center bg-gray-50 rounded-t-md">
                                <h3 class="font-medium text-gray-800">Notifications</h3>
                                <button id="markAllAsRead" class="text-xs text-blue-600 hover:underline">Tout marquer comme lu</button>
                            </div>
                            
                            <div id="notificationList" class="max-h-96 overflow-y-auto">
                                @forelse(auth()->user()->notifications->take(10) as $notification)
                                    <a href="{{ $notification->data['url'] ?? '#' }}" class="block p-3 hover:bg-gray-50 transition-colors duration-150 {{ $notification->unread() ? 'bg-blue-50' : '' }}">
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0 pt-0.5">
                                                @if(isset($notification->data['type']))
                                                    @if($notification->data['type'] == 'nouvelle_annonce')
                                                        <i class="fas fa-bullhorn text-green-500"></i>
                                                    @elseif($notification->data['type'] == 'reclamation_reponse')
                                                        <i class="fas fa-reply text-blue-500"></i>
                                                    @elseif($notification->data['type'] == 'reservation_expiration')
                                                        <i class="fas fa-clock text-orange-500"></i>
                                                    @else
                                                        <i class="fas fa-bell text-gray-400"></i>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="ml-3 flex-1 min-w-0">
                                                @if(isset($notification->data['type']) && $notification->data['type'] == 'reservation_expiration')
                                                    <p class="font-medium text-gray-800">Réservation expirante</p>
                                                    <p class="text-sm text-gray-600 mt-1">
                                                        Votre réservation #{{ $notification->data['reservation_id'] ?? '' }} expire bientôt
                                                    </p>
                                                    <p class="text-xs text-orange-600 mt-1">
                                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                                        Expire dans: {{ round(floatval(str_replace('Réservation se termine dans ', '', $notification->data['message'] ?? '0'))) }}h
                                                    </p>
                                                @else
                                                    <p class="font-medium text-gray-800">
                                                        @if(isset($notification->data['type']))
                                                            @if($notification->data['type'] == 'nouvelle_annonce')
                                                                Nouvelle annonce
                                                            @elseif($notification->data['type'] == 'reclamation_reponse')
                                                                Réponse à votre réclamation
                                                            @else
                                                                Notification
                                                            @endif
                                                        @endif
                                                    </p>
                                                    
                                                    <p class="text-sm text-gray-600 mt-1">
                                                        {{ $notification->data['message'] ?? '' }}
                                                    </p>
                                                    
                                                    @if(isset($notification->data['type']) && $notification->data['type'] == 'reclamation_reponse')
                                                        <p class="text-xs text-gray-700 mt-1 bg-gray-100 p-1 rounded">
                                                            <strong>Sujet:</strong> {{ $notification->data['sujet'] ?? '' }}
                                                        </p>
                                                    @endif
                                                @endif
                                                
                                                <p class="text-xs text-gray-500 mt-2 flex items-center">
                                                    <i class="far fa-clock mr-1"></i>
                                                    {{ $notification->created_at->diffForHumans() }}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <div class="p-6 text-center text-gray-400">
                                        <i class="far fa-bell-slash text-2xl mb-2"></i>
                                        <p class="text-sm">Aucune notification disponible</p>
                                    </div>
                                @endforelse
                            </div>
                            
                            <div class="p-2 text-center bg-gray-50 rounded-b-md">
                                <a href="{{ route('client.notifications') }}" class="text-sm text-blue-600 hover:underline">Voir toutes les notifications</a>
                            </div>
                        </div>
                    </div>

                    <div class="relative">
                        <button class="w-9 h-9 rounded-full bg-gradient-to-r from-blue-400 to-blue-600 flex items-center justify-center text-white hover:opacity-90 transition">
                            <i class="fas fa-user text-sm"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const notificationButton = document.getElementById('notificationButton');
        const notificationDropdown = document.getElementById('notificationDropdown');
        const notificationList = document.getElementById('notificationList');
        const markAllAsRead = document.getElementById('markAllAsRead');
        let notificationBadge = document.getElementById('notificationBadge');

        function formatExpirationMessage(message) {
            const hours = parseFloat(message.replace('Réservation se termine dans ', '').replace('h', ''));
            return Math.round(hours) + 'h';
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

            notificationList.innerHTML = notifications.map(notif => `
                <a href="${notif.data.url || '#'}" class="block p-3 hover:bg-gray-50 transition-colors duration-150 ${notif.read_at ? '' : 'bg-blue-50'}">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 pt-0.5">
                            ${notif.data.type === 'reservation_expiration' ? 
                                '<i class="fas fa-clock text-orange-500"></i>' :
                                notif.data.type === 'reclamation_reponse' ? 
                                '<i class="fas fa-reply text-blue-500"></i>' :
                                notif.data.type === 'nouvelle_annonce' ?
                                '<i class="fas fa-bullhorn text-green-500"></i>' :
                                '<i class="fas fa-bell text-gray-400"></i>'}
                        </div>
                        <div class="ml-3 flex-1 min-w-0">
                            ${notif.data.type === 'reservation_expiration' ? `
                                <p class="font-medium text-gray-800">Réservation expirante</p>
                                <p class="text-sm text-gray-600 mt-1">
                                    Votre réservation #${notif.data.reservation_id || ''} expire bientôt
                                </p>
                                <p class="text-xs text-orange-600 mt-1">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    Expire dans: ${formatExpirationMessage(notif.data.message || '0h')}
                                </p>
                            ` : `
                                <p class="font-medium text-gray-800">
                                    ${notif.data.type === 'nouvelle_annonce' ? 'Nouvelle annonce' : 
                                     notif.data.type === 'reclamation_reponse' ? 'Réponse à votre réclamation' : 'Notification'}
                                </p>
                                <p class="text-sm text-gray-600 mt-1">
                                    ${notif.data.message || ''}
                                </p>
                                ${notif.data.type === 'reclamation_reponse' ? `
                                    <p class="text-xs text-gray-700 mt-1 bg-gray-100 p-1 rounded">
                                        <strong>Sujet:</strong> ${notif.data.sujet || ''}
                                    </p>
                                ` : ''}
                            `}
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
                        </div>
                    </div>
                </a>
            `).join('');
        }

        function updateNotificationBadge() {
            fetch('/client/notifications/unread-count')
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

        function loadNotifications() {
            fetch('/client/notifications/latest')
                .then(response => response.json())
                .then(data => {
                    renderNotifications(data);
                    updateNotificationBadge();
                });
        }

        if (markAllAsRead) {
            markAllAsRead.addEventListener('click', function(e) {
                e.preventDefault();
                fetch('/client/notifications/mark-as-read', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json'
                    }
                }).then(() => {
                    document.querySelectorAll('.bg-blue-50').forEach(el => {
                        el.classList.remove('bg-blue-50');
                    });
                    updateNotificationBadge();
                });
            });
        }

        if (notificationButton) {
            notificationButton.addEventListener('click', function(e) {
                e.stopPropagation();
                notificationDropdown.classList.toggle('hidden');
                loadNotifications();
            });
        }

        document.addEventListener('click', function() {
            notificationDropdown.classList.add('hidden');
        });

        notificationDropdown?.addEventListener('click', function(e) {
            e.stopPropagation();
        });

        updateNotificationBadge();
        loadNotifications();

        setInterval(updateNotificationBadge, 30000);
    });
    </script>
</body>
</html>