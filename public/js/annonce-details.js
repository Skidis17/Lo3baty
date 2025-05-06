document.addEventListener('DOMContentLoaded', function() {
    const { reservedPeriods, annonceStartDate, annonceEndDate, dailyPrice } = window.reservationData;
    
    // Convert reserved periods to disabled dates for Flatpickr
    const disabledDates = reservedPeriods.map(period => ({
        from: period.start,
        to: period.end
    }));
    
    // Initialize date pickers
    const dateDebutInput = flatpickr("#date_debut", {
        locale: "fr",
        minDate: "today",
        maxDate: annonceEndDate,
        disable: disabledDates,
        dateFormat: "Y-m-d",
        onChange: function(selectedDates, dateStr) {
            dateFinInput.set('minDate', dateStr);
            dateFinInput.set('disable', disabledDates);
            calculatePrice();
        }
    });
    
    const dateFinInput = flatpickr("#date_fin", {
        locale: "fr",
        minDate: "today",
        maxDate: annonceEndDate,
        disable: disabledDates,
        dateFormat: "Y-m-d",
        onChange: function() {
            calculatePrice();
        }
    });
    
    function calculatePrice() {
        const startDate = dateDebutInput.selectedDates[0];
        const endDate = dateFinInput.selectedDates[0];
        
        if (startDate && endDate) {
            const diffTime = Math.abs(endDate - startDate);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
            const totalPrice = diffDays * dailyPrice;
            
            document.getElementById('durationDays').textContent = diffDays;
            document.getElementById('totalPrice').textContent = totalPrice;
            document.getElementById('priceCalculation').classList.remove('hidden');
        }
    }
    
    document.getElementById('reservationForm').addEventListener('submit', function(e) {
        const startDate = dateDebutInput.selectedDates[0];
        const endDate = dateFinInput.selectedDates[0];
        
        if (!startDate || !endDate) {
            e.preventDefault();
            alert('Veuillez sélectionner les dates de réservation.');
            return;
        }
        
        if (startDate > endDate) {
            e.preventDefault();
            alert('La date de fin doit être après la date de début.');
            return;
        }
        
        if (!checkAvailability(startDate, endDate)) {
            e.preventDefault();
            alert('Cette période n\'est plus disponible. Veuillez choisir d\'autres dates.');
        }
    });
    
    function checkAvailability(startDate, endDate) {
        return !reservedPeriods.some(period => {
            const periodStart = new Date(period.start);
            const periodEnd = new Date(period.end);
            
            return (startDate >= periodStart && startDate <= periodEnd) ||
                   (endDate >= periodStart && endDate <= periodEnd) ||
                   (startDate <= periodStart && endDate >= periodEnd);
        });
    }
    
});
