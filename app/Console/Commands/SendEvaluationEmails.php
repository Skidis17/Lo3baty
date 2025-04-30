<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use Illuminate\Support\Facades\Mail;
use App\Mail\EvaluationMail;
use Carbon\Carbon;

class SendEvaluationEmails extends Command
{
    protected $signature = 'send:evaluation-emails';
    protected $description = 'Send evaluation emails to users after reservation ends';

    public function handle()
    {
        $today = Carbon::today();
        $now = Carbon::now();
    
        $this->info("Starting process at {$now->toDateTimeString()}");
    
        // Debug: Show the exact query being executed
        $query = Reservation::whereDate('date_fin', $today)
            ->whereNull('evaluation_date')
            ->where('is_evaluation')
            ->with(['utilisateur:id,email', 'objet']);
    
        $this->info("SQL Query: " . $query->toSql());
        $this->info("Query Bindings: " . json_encode($query->getBindings()));
    
        $reservations = $query->get();
        $this->info("Found {$reservations->count()} reservations");
    
    // Get reservations ending today that haven't been evaluated
    $reservations = Reservation::whereDate('date_fin', $today) 
        ->whereNull('evaluation_date')
        ->where('is_evaluation') 
        ->with(['utilisateur:id,email', 'objet'])
        ->get();

    $this->info("Found {$reservations->count()} eligible reservations");

    $sentCount = 0;

    foreach ($reservations as $reservation) {
        try {
            // Validate reservation data
            if (!$reservation->relationLoaded('utilisateur') || !$reservation->utilisateur) {
                $this->error("No user found for reservation ID: {$reservation->id}");
                continue;
            }

            $userEmail = $reservation->utilisateur->email;
            
            if (empty($userEmail)) {
                $this->error("Empty email for reservation ID: {$reservation->id}");
                continue;
            }

            $dateFin = Carbon::parse($reservation->date_fin);
            if (!$dateFin->isSameDay($today)) {
                $this->error("Date mismatch for reservation ID: {$reservation->id} ({$dateFin})");
                continue;
            }

            Mail::to($userEmail)->send(new EvaluationMail($reservation));
            
            $reservation->update([
                'evaluation_date' => $now,
                'is_evaluation' => true
            ]);

            $sentCount++;
            $this->info("Successfully sent to: {$userEmail}");

        } catch (\Exception $e) {
            $this->error("Failed reservation ID {$reservation->id}: " . $e->getMessage());
        }
    }

    $this->info("Successfully sent {$sentCount}/{$reservations->count()} emails.");
}
}
