<?php
namespace App\Http\Controllers;

use App\Models\Reclamation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ReclamationController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            Auth::user()->unreadNotifications->markAsRead();
        }
    
        $reclamations = Reclamation::where('utilisateur_id', Auth::id())->get();
    
        return view('client.reclamations', compact('reclamations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sujet' => 'required|string|max:255',
            'contenu' => 'required|string',
            'piece_jointe' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $pieceJointePath = null;
        if ($request->hasFile('piece_jointe')) {
            $file = $request->file('piece_jointe');
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            
            $fileName = pathinfo($originalName, PATHINFO_FILENAME);
            $uniqueName = $fileName . '_' . Str::random(10) . '.' . $extension;
            
            $pieceJointePath = $file->storeAs('reclamations', $uniqueName, 'public');
        }

        Reclamation::create([
            'sujet' => $validated['sujet'],
            'contenu' => $validated['contenu'],
            'piece_jointe' => $pieceJointePath ? basename($pieceJointePath) : null,
            'utilisateur_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Réclamation envoyée avec succès.');
    }

    public function show($id)
    {
        $reclamation = Reclamation::where('id', $id)
            ->where('utilisateur_id', Auth::id()) 
            ->firstOrFail();
    
        return response()->json([
            'id' => $reclamation->id,
            'sujet' => $reclamation->sujet,
            'contenu' => $reclamation->contenu,
            'statut' => $reclamation->statut,
            'created_at' => $reclamation->created_at,
            'piece_jointe' => $reclamation->piece_jointe
                ? route('reclamation.file', ['filename' => $reclamation->piece_jointe])
                : null,
        ]);
    }

    public function downloadFile($filename)
    {
        $path = storage_path('app/public/reclamations/' . $filename);
        
        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path, [
            'Content-Disposition' => 'inline; filename="'.$filename.'"'
        ]);
    }
}