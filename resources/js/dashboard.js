// Importer Chart.js ou FullCalendar selon vos besoins

import Chart from 'chart.js/auto';
import FullCalendar from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';

// Graphique des revenus locatifs
const ctx = document.getElementById('revenueChart').getContext('2d');
const revenueChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],  // Exemples de mois
        datasets: [{
            label: 'Revenus locatifs (MAD)',
            data: [1200, 1500, 1800, 2200, 2500, 2800],  // Remplir avec vos données
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Calendrier locatif
const calendarEl = document.getElementById('calendar');
const calendar = new FullCalendar.Calendar(calendarEl, {
    plugins: [dayGridPlugin],
    initialView: 'dayGridMonth',
    events: [
        { title: 'Réservation A', start: '2025-04-01', end: '2025-04-03' },
        { title: 'Réservation B', start: '2025-04-05', end: '2025-04-06' },
        // Ajoutez vos événements ici
    ]
});

calendar.render();
