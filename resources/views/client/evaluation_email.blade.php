<h1>Bonjour {{ $utilisateur->nom ?? '' }} {{ $utilisateur->prenom ?? '' }},</h1>

<p>Merci d'avoir utilisé notre service de location de jouets <strong>Lo3baty</strong>.</p>

<p>Votre réservation <strong>#{{ $reservation->id }}</strong> est terminée avec succès.</p>

<p>
    Vous avez réservé <strong>{{ $objet->nom ?? 'un jouet' }}</strong> du 
    <strong>{{ \Carbon\Carbon::parse($reservation->date_debut)->format('d/m/Y') }}</strong> 
    au <strong>{{ \Carbon\Carbon::parse($reservation->date_fin)->format('d/m/Y') }}</strong>.
</p>

<p>Nous serions ravis d'avoir votre avis pour améliorer nos services.</p>

<p>
    <a href="https://your-google-form-link.com" style="font-weight: bold; color: #1a73e8;">
        Remplir le formulaire
    </a>
</p>

<br>

<p>Cordialement,<br>
L'équipe <strong>Lo3baty</strong></p>

<p>
    <img src="public\images\Lo3baty.jpg" alt="Lo3baty Logo" width="150">
</p>
