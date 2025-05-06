<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Réclamations - Design Premium</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: {
              50: '#f0f9ff',
              100: '#e0f2fe',
              200: '#bae6fd',
              300: '#7dd3fc',
              400: '#38bdf8',
              500: '#0ea5e9',
              600: '#0284c7',
              700: '#0369a1',
              800: '#075985',
              900: '#0c4a6e',
            }
          }
        }
      }
    }
  </script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    
    :root {
      --color-primary: #0ea5e9;
      --color-primary-dark: #0369a1;
      --color-secondary: #f43f5e;
    }
    
    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
      min-height: 100vh;
    }
    
    /* Animations */
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes float {
      0% { transform: translateY(0px); }
      50% { transform: translateY(-5px); }
      100% { transform: translateY(0px); }
    }
    
    .modal-animation {
      animation: fadeIn 0.3s cubic-bezier(0.22, 1, 0.36, 1) forwards;
    }
    
    .float-animation {
      animation: float 6s ease-in-out infinite;
    }
    
    /* Glassmorphism effect */
    .glass-card {
      background: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      border: 1px solid rgba(255, 255, 255, 0.3);
      box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05);
    }
    
    /* Boutons */
    .btn-primary {
      background: linear-gradient(to right, var(--color-primary), var(--color-primary-dark));
      box-shadow: 0 4px 6px rgba(14, 165, 233, 0.2);
      transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(14, 165, 233, 0.3);
      background: linear-gradient(to right, var(--color-primary-dark), var(--color-primary));
    }
    
    .btn-secondary {
      transition: all 0.3s ease;
      border: 1px solid #e2e8f0;
    }
    
    .btn-secondary:hover {
      background-color: #f8fafc;
      border-color: #cbd5e1;
    }
    
    /* Table */
    .table-row {
      transition: all 0.2s ease;
    }
    
    .table-row:hover {
      background-color: rgba(241, 245, 249, 0.6);
      transform: translateX(2px);
    }
    
    /* Status badges */
    .status-badge {
      font-size: 0.7rem;
      letter-spacing: 0.05em;
      padding: 0.25rem 0.75rem;
      border-radius: 9999px;
    }
    
    .status-pending {
      background-color: #fef3c7;
      color: #92400e;
    }
    
    .status-in-progress {
      background-color: #dbeafe;
      color: #1e40af;
    }
    
    .status-resolved {
      background-color: #dcfce7;
      color: #166534;
    }
    
    /* Response bubble */
    .response-bubble {
      position: relative;
      background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
      border-radius: 12px 12px 12px 0;
    }
    
    .response-bubble::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: -12px;
      width: 0;
      height: 0;
      border-style: solid;
      border-width: 0 0 12px 12px;
      border-color: transparent transparent #bae6fd transparent;
    }
    
    ::-webkit-scrollbar {
      width: 6px;
      height: 6px;
    }
    
    ::-webkit-scrollbar-track {
      background: rgba(241, 245, 249, 0.5);
    }
    
    ::-webkit-scrollbar-thumb {
      background: rgba(148, 163, 184, 0.3);
      border-radius: 3px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
      background: rgba(148, 163, 184, 0.5);
    }
    
    .bg-elements {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      overflow: hidden;
      z-index: -1;
      pointer-events: none;
    }
    
    .bg-element {
      position: absolute;
      border-radius: 50%;
      filter: blur(60px);
      opacity: 0.15;
    }
  </style>
</head>
<body class="antialiased text-slate-800">
  
  <div class="bg-elements">
    <div class="bg-element bg-blue-400 w-64 h-64 top-1/4 left-10 float-animation"></div>
    <div class="bg-element bg-cyan-400 w-72 h-72 top-2/3 right-20 float-animation" style="animation-delay: 2s;"></div>
    <div class="bg-element bg-sky-400 w-60 h-60 bottom-20 left-1/3 float-animation" style="animation-delay: 4s;"></div>
  </div>

  <main class="container mx-auto px-4 py-8 relative z-10">
   
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
      <div>
        <h1 class="text-3xl md:text-4xl font-bold text-slate-800">Mes Réclamations</h1>
        <p class="text-slate-500 mt-2">Suivi et gestion de vos réclamations</p>
      </div>
      <button onclick="openNewModal()" class="btn-primary text-white px-6 py-3 rounded-xl flex items-center space-x-2">
        <i class="fas fa-plus"></i>
        <span>Nouvelle Réclamation</span>
      </button>
    </div>

    
    <div class="glass-card rounded-xl overflow-hidden mb-8">
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200/70">
          <thead class="bg-slate-50/80">
            <tr>
              <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Référence</th>
              <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Sujet</th>
              <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Date</th>
              <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Statut</th>
              <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-200/50">
            @foreach ($reclamations as $reclamation)
            <tr class="table-row">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="bg-blue-100 p-2 rounded-lg mr-3">
                    <i class="fas fa-ticket-alt text-blue-500"></i>
                  </div>
                  <span class="font-medium text-blue-600">#REC-{{ $reclamation->id }}</span>
                </div>
              </td>
              <td class="px-6 py-4">
                <p class="font-medium text-slate-800">{{ $reclamation->sujet }}</p>
                <p class="text-slate-500 text-sm mt-1 truncate max-w-xs">{{ Str::limit($reclamation->contenu, 50) }}</p>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <i class="far fa-calendar-alt text-slate-400 mr-2"></i>
                  <span>{{ $reclamation->created_at->format('d/m/Y') }}</span>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="status-badge 
                  {{ $reclamation->statut == 'en_attente' ? 'status-pending' : 
                     ($reclamation->statut == 'en_cours' ? 'status-in-progress' : 'status-resolved') }}">
                  {{ ucfirst(str_replace('_', ' ', $reclamation->statut)) }}
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <button onclick="viewComplaint(this)" data-id="{{ $reclamation->id }}" class="text-blue-500 hover:text-blue-700 transition-colors p-2 rounded-full hover:bg-blue-50">
                  <i class="fas fa-eye"></i>
                </button>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between items-center text-sm text-slate-500 gap-4">
      <p>Affichage de 1 à {{ count($reclamations) }} sur {{ count($reclamations) }} réclamation(s)</p>
      <div class="flex space-x-2">
        <button class="btn-secondary px-4 py-2 rounded-xl opacity-50" disabled>
          <i class="fas fa-chevron-left mr-2"></i> Précédent
        </button>
        <button class="btn-secondary px-4 py-2 rounded-xl opacity-50" disabled>
          Suivant <i class="fas fa-chevron-right ml-2"></i>
        </button>
      </div>
    </div>
  </main>

  <div id="complaintModal" class="fixed inset-0 bg-black/30 flex items-center justify-center z-50 hidden p-4 backdrop-blur-sm">
    <div class="glass-card w-full max-w-2xl max-h-[90vh] overflow-y-auto modal-animation">
      <div class="p-8">
        <div class="flex justify-between items-center mb-6">
          <div>
            <h3 class="text-2xl font-bold text-slate-800">Détails de la réclamation</h3>
            <div class="flex items-center mt-2 space-x-4">
              <span id="complaintReference" class="font-mono text-blue-600"></span>
              <span id="complaintStatus" class="status-badge"></span>
            </div>
          </div>
          <button onclick="closeModal()" class="text-slate-400 hover:text-slate-600 transition-colors p-2 rounded-full hover:bg-slate-100">
            <i class="fas fa-times text-xl"></i>
          </button>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
          <div class="bg-slate-50/70 p-4 rounded-xl">
            <p class="text-sm text-slate-500 mb-1">Date de création</p>
            <p id="complaintDate" class="font-medium"></p>
          </div>
          <div class="bg-slate-50/70 p-4 rounded-xl">
            <p class="text-sm text-slate-500 mb-1">Dernière mise à jour</p>
            <p id="complaintUpdateDate" class="font-medium"></p>
          </div>
        </div>
        
        <div class="bg-white/80 p-6 rounded-xl mb-6">
          <h4 class="font-bold text-lg text-slate-800 mb-3 flex items-center">
            <i class="fas fa-tag text-blue-500 mr-2"></i>
            <span id="complaintSubject"></span>
          </h4>
          <div class="prose prose-sm max-w-none text-slate-600">
            <p id="complaintMessage" class="whitespace-pre-line"></p>
          </div>
        </div>
        
        <div id="complaintAttachment" class="hidden mb-6">
          <div class="bg-slate-50/70 p-4 rounded-xl flex items-center justify-between">
            <div class="flex items-center">
              <div class="bg-blue-100 p-3 rounded-lg mr-4">
                <i class="fas fa-paperclip text-blue-500"></i>
              </div>
              <div>
                <p class="font-medium text-slate-800">Pièce jointe</p>
                <p class="text-sm text-slate-500">Document fourni avec la réclamation</p>
              </div>
            </div>
            <a id="attachmentLink" href="#" target="_blank" class="btn-primary px-4 py-2 rounded-lg text-sm">
              <i class="fas fa-download mr-2"></i> Télécharger
            </a>
          </div>
        </div>
        
        <div id="responseSection" class="hidden">
          <h4 class="font-bold text-lg text-slate-800 mb-4 flex items-center">
            <i class="fas fa-reply text-blue-500 mr-2"></i>
            Réponse du support
          </h4>
          <div class="response-bubble p-6 mb-4">
            <p id="responseContent" class="whitespace-pre-line"></p>
          </div>
          <p id="responseDate" class="text-sm text-slate-500 text-right">
            <i class="far fa-clock mr-1"></i> Réponse du <span class="font-medium"></span>
          </p>
        </div>
        
        <div class="flex justify-end mt-8">
          <button onclick="closeModal()" class="btn-primary px-6 py-3 rounded-xl">
            Fermer
          </button>
        </div>
      </div>
    </div>
  </div>

  <div id="newComplaintModal" class="fixed inset-0 bg-black/30 flex items-center justify-center z-50 hidden p-4 backdrop-blur-sm">
    <div class="glass-card w-full max-w-2xl max-h-[90vh] overflow-y-auto modal-animation">
      <div class="p-8">
        <div class="flex justify-between items-center mb-6">
          <div>
            <h3 class="text-2xl font-bold text-slate-800">Nouvelle réclamation</h3>
            <p class="text-slate-500 mt-2">Remplissez le formulaire pour soumettre une nouvelle réclamation</p>
          </div>
          <button onclick="closeNewModal()" class="text-slate-400 hover:text-slate-600 transition-colors p-2 rounded-full hover:bg-slate-100">
            <i class="fas fa-times text-xl"></i>
          </button>
        </div>
        
        <form action="{{ route('reclamations.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="space-y-6">
            <div>
              <label class="block text-sm font-medium text-slate-700 mb-2">Sujet *</label>
              <input type="text" name="sujet" required 
                     class="w-full border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white/70">
            </div>
            
            <div>
              <label class="block text-sm font-medium text-slate-700 mb-2">Message *</label>
              <textarea name="contenu" required rows="5" 
                        class="w-full border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white/70"></textarea>
            </div>
            
            <div>
              <label class="block text-sm font-medium text-slate-700 mb-2">Pièce jointe</label>
              <div class="mt-1 flex flex-col sm:flex-row items-start sm:items-center gap-4">
                <label class="cursor-pointer">
                  <input type="file" name="piece_jointe" id="file-upload" class="sr-only">
                  <div class="btn-primary px-6 py-3 rounded-xl inline-flex items-center">
                    <i class="fas fa-cloud-upload-alt mr-2"></i>
                    <span>Choisir un fichier</span>
                  </div>
                </label>
                <div id="file-info" class="text-sm text-slate-500">
                  <span id="file-name">Aucun fichier sélectionné</span>
                  <span id="file-size" class="ml-2"></span>
                </div>
              </div>
            </div>
            
            <div class="flex justify-end space-x-4 pt-4">
              <button type="button" onclick="closeNewModal()" class="btn-secondary px-6 py-3 rounded-xl">
                Annuler
              </button>
              <button type="submit" class="btn-primary px-6 py-3 rounded-xl flex items-center">
                <i class="fas fa-paper-plane mr-2"></i>
                <span>Envoyer la réclamation</span>
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    document.getElementById('file-upload').addEventListener('change', function(e) {
      const file = e.target.files[0];
      if (file) {
        document.getElementById('file-name').textContent = file.name;
        document.getElementById('file-size').textContent = `(${(file.size / 1024).toFixed(1)} KB)`;
      } else {
        document.getElementById('file-name').textContent = 'Aucun fichier sélectionné';
        document.getElementById('file-size').textContent = '';
      }
    });

    function openNewModal() {
      document.getElementById('newComplaintModal').classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    }
    
    function closeNewModal() {
      document.getElementById('newComplaintModal').classList.add('hidden');
      document.body.style.overflow = 'auto';
    }
    
    function viewComplaint(button) {
      const complaintId = button.getAttribute('data-id');

      fetch(`/reclamations/${complaintId}`)
        .then(response => {
          if (!response.ok) {
            throw new Error('Erreur lors de la récupération des données');
          }
          return response.json();
        })
        .then(data => {
          document.getElementById('complaintReference').textContent = `#REC-${data.id}`;
          document.getElementById('complaintDate').textContent = new Date(data.created_at).toLocaleDateString('fr-FR', { 
            day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' 
          });
          document.getElementById('complaintUpdateDate').textContent = new Date(data.updated_at).toLocaleDateString('fr-FR', { 
            day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' 
          });
          
          const statusElement = document.getElementById('complaintStatus');
          let statusClass = '';
          let statusText = '';
          
          switch(data.statut) {
            case 'en_attente':
              statusClass = 'status-badge status-pending';
              statusText = 'En attente';
              break;
            case 'en_cours':
              statusClass = 'status-badge status-in-progress';
              statusText = 'En cours';
              break;
            case 'resolu':
              statusClass = 'status-badge status-resolved';
              statusText = 'Résolu';
              break;
            default:
              statusClass = 'status-badge';
              statusText = data.statut;
          }
          
          statusElement.className = statusClass;
          statusElement.textContent = statusText;
          
          document.getElementById('complaintSubject').textContent = data.sujet;
          document.getElementById('complaintMessage').textContent = data.contenu;

          const attachmentElement = document.getElementById('complaintAttachment');
          if (data.piece_jointe) {
            attachmentElement.classList.remove('hidden');
            document.getElementById('attachmentLink').href = data.piece_jointe;
          } else {
            attachmentElement.classList.add('hidden');
          }
          
          const responseSection = document.getElementById('responseSection');
          if (data.reponse) {
            responseSection.classList.remove('hidden');
            document.getElementById('responseContent').textContent = data.reponse.contenu;
            document.getElementById('responseDate').querySelector('span').textContent = 
              new Date(data.reponse.created_at).toLocaleDateString('fr-FR', { 
                day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' 
              });
          } else {
            responseSection.classList.add('hidden');
          }

          document.getElementById('complaintModal').classList.remove('hidden');
          document.body.style.overflow = 'hidden';
        })
        .catch(error => {
          console.error('Erreur:', error);
          alert('Impossible de charger les détails de la réclamation.');
        });
    }
    
    function closeModal() {
      document.getElementById('complaintModal').classList.add('hidden');
      document.body.style.overflow = 'auto';
    }
  </script>
</body>
</html>