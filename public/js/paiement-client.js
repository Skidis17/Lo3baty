document.addEventListener('DOMContentLoaded', function() {
   
    const paymentForm = document.getElementById('paymentForm');
    const reserveNowBtn = document.querySelector('#reservationForm button[type="submit"]');
    
    if (reserveNowBtn) {
        reserveNowBtn.addEventListener('click', function(e) {
            e.preventDefault();
          
            const dateDebut = document.getElementById('date_debut').value;
            const dateFin = document.getElementById('date_fin').value;
            
            if (!dateDebut || !dateFin) {
                alert('Veuillez sélectionner les dates de réservation');
                return;
            }
       
            showPaymentPopup();
        });
    }
   
    function showPaymentPopup() {
        const formData = new FormData(document.getElementById('reservationForm'));
        
        fetch("{{ route('reservation.store') }}", {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
             
                window.location.href = `/paiement/${data.reservation_id}/show`;
            } else {
                alert('Erreur lors de la réservation: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Une erreur est survenue lors de la réservation');
        });
    }
    
    const livraisonOui = document.getElementById('livraison_oui');
    const livraisonNon = document.getElementById('livraison_non');
    const totalAmountElement = document.getElementById('totalAmount');
    
    if (livraisonOui && livraisonNon) {
        [livraisonOui, livraisonNon].forEach(radio => {
            radio.addEventListener('change', function() {
                updateTotalAmount();
            });
        });
    }
    
    function updateTotalAmount() {
        const baseAmount = parseFloat(document.getElementById('baseAmount').textContent);
        const livraisonAmount = parseFloat(document.getElementById('livraisonAmount').textContent);
        
        if (livraisonOui.checked) {
            totalAmountElement.textContent = (baseAmount + livraisonAmount).toFixed(2);
        } else {
            totalAmountElement.textContent = baseAmount.toFixed(2);
        }
    }

    if (paymentForm) {
        paymentForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(paymentForm);
            
            fetch(paymentForm.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Paiement effectué avec succès!');
                    window.location.href = "{{ route('reservations') }}";
                } else {
                    alert('Erreur lors du paiement: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Une erreur est survenue lors du paiement');
            });
        });
    }
});