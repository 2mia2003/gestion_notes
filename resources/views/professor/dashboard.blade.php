@extends('layouts.app')

@section('title', 'Tableau de bord - Professeur')
@section('breadcrumb', 'Professeur / Tableau de bord')

@section('content')
<div class="space-y-6">
    <!-- En-tête avec retour -->
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('professor.welcome') }}" class="text-blue-600 hover:text-blue-700 font-bold text-sm inline-flex items-center gap-2">
            <span class="material-symbols-outlined text-[20px]">arrow_back</span>
            Retour à l'accueil
        </a>
    </div>

    <!-- En-tête -->
    <div class="bg-white dark:bg-[#1a2230] rounded-xl border border-[#e7ebf3] dark:border-gray-800 p-6 shadow-sm">
        <h1 class="text-3xl font-bold text-[#0d121b] dark:text-white">Tableau de bord</h1>
        <p class="text-[#4c669a] dark:text-gray-400 mt-2">Gérez vos étudiants et vos notes.</p>
    </div>

    <!-- Onglets pour Étudiants et Import -->
    <div class="bg-white dark:bg-[#1a2230] rounded-xl border border-[#e7ebf3] dark:border-gray-800 shadow-sm overflow-hidden">
        <div class="flex border-b border-[#e7ebf3] dark:border-gray-800 bg-gray-50 dark:bg-[#111827]">
            <button class="tab-button active px-6 py-4 font-bold text-sm text-blue-600 border-b-2 border-blue-600 transition"
                    data-tab="students">
                Mes étudiants
            </button>
            <button class="tab-button px-6 py-4 font-bold text-sm text-[#4c669a] dark:text-gray-400 border-b-2 border-transparent hover:text-[#0d121b] dark:hover:text-white transition"
                    data-tab="import">
                Importer des notes
            </button>
        </div>

        <!-- Tab: Mes étudiants -->
        <div id="tab-students" class="tab-content block p-6">
            @if($etudiants->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50 dark:bg-[#111827] border-b border-[#e7ebf3] dark:border-gray-800">
                                <th class="px-6 py-4 text-left text-xs font-bold text-[#4c669a] dark:text-gray-400 uppercase tracking-wider">Matricule</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-[#4c669a] dark:text-gray-400 uppercase tracking-wider">Nom</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-[#4c669a] dark:text-gray-400 uppercase tracking-wider">Prénom</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-[#4c669a] dark:text-gray-400 uppercase tracking-wider">Module</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-[#4c669a] dark:text-gray-400 uppercase tracking-wider">Notes</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#e7ebf3] dark:divide-gray-800">
                            @foreach($etudiants as $etudiant)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">
                                    <td class="px-6 py-4 text-sm font-bold text-[#0d121b] dark:text-white">{{ $etudiant['matricule'] ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 text-sm text-[#0d121b] dark:text-white">{{ $etudiant['nom'] }}</td>
                                    <td class="px-6 py-4 text-sm text-[#0d121b] dark:text-white">{{ $etudiant['prenom'] }}</td>
                                    <td class="px-6 py-4 text-sm text-[#0d121b] dark:text-white">{{ $etudiant['module'] }}</td>
                                    <td class="px-6 py-4">
                                        @if(!empty($etudiant['notes']))
                                            <div class="flex flex-wrap gap-2">
                                                @foreach($etudiant['notes'] as $note)
                                                    <span class="bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 px-3 py-1 rounded-full text-xs font-bold">
                                                        {{ $note['type'] }}: {{ $note['valeur'] }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="text-[#4c669a] dark:text-gray-400 text-xs">Aucune note</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-12 px-6">
                    <svg class="w-16 h-16 text-[#d9e5ef] dark:text-gray-700 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                    <p class="text-[#4c669a] dark:text-gray-400 font-semibold">Aucun étudiant trouvé</p>
                    <p class="text-sm text-[#4c669a] dark:text-gray-500 mt-1">Vous n'avez pas d'étudiants assignés.</p>
                </div>
            @endif
        </div>

        <!-- Tab: Importer des notes -->
        <div id="tab-import" class="tab-content hidden p-6">
            <div class="max-w-2xl">
                <h3 class="text-lg font-bold text-[#0d121b] dark:text-white mb-4">Importer les notes par CSV</h3>
                
                <div class="bg-gray-50 dark:bg-[#111827] rounded-lg border-2 border-dashed border-[#d9e5ef] dark:border-gray-700 p-8 text-center mb-6">
                    <svg class="w-12 h-12 text-[#4c669a] dark:text-gray-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <p class="text-sm text-[#4c669a] dark:text-gray-400 font-semibold mb-2">Glissez-déposez votre fichier CSV ici</p>
                    <p class="text-xs text-[#4c669a] dark:text-gray-500">ou</p>
                    <button type="button" class="text-blue-600 hover:text-blue-700 font-bold text-sm mt-2">
                        Parcourir les fichiers
                    </button>
                    <p class="text-xs text-[#4c669a] dark:text-gray-500 mt-3">Format: CSV avec colonnes MatriculeEtudiant, Module, Type, Note</p>
                </div>

                <div class="bg-blue-50 dark:bg-blue-900/10 rounded-lg border border-blue-200 dark:border-blue-800 p-4">
                    <p class="text-sm text-blue-700 dark:text-blue-300">
                        <strong>Format attendu du fichier CSV :</strong><br>
                        <code class="text-xs bg-white dark:bg-[#111827] px-2 py-1 rounded mt-2 block">
                            matricule,module_code,type,note<br>
                            E001,INFO101,EXAM,15.5<br>
                            E001,INFO101,CC,16.0
                        </code>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Ajouter une note rapidement -->
    <div class="bg-white dark:bg-[#1a2230] rounded-xl border border-[#e7ebf3] dark:border-gray-800 p-6 shadow-sm">
        <h3 class="text-lg font-bold text-[#0d121b] dark:text-white mb-4">Ajouter une note rapidement</h3>
        
        <form method="POST" action="#" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Étudiant -->
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-[#0d121b] dark:text-white">Étudiant *</label>
                    <select name="etudiant_id" class="w-full rounded-lg border border-[#e7ebf3] dark:border-gray-700 bg-white dark:bg-[#111827] px-4 py-3 text-[#0d121b] dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                        <option value="">-- Sélectionner un étudiant --</option>
                        @foreach($etudiants as $etudiant)
                            <option value="{{ $etudiant['id'] }}">{{ $etudiant['nom'] }} {{ $etudiant['prenom'] }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Type de note -->
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-[#0d121b] dark:text-white">Type *</label>
                    <select name="type" class="w-full rounded-lg border border-[#e7ebf3] dark:border-gray-700 bg-white dark:bg-[#111827] px-4 py-3 text-[#0d121b] dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                        <option value="">-- Sélectionner un type --</option>
                        <option value="EXAM">EXAM</option>
                        <option value="CC">Contrôle Continu</option>
                        <option value="TP">TP</option>
                    </select>
                </div>

                <!-- Note -->
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-[#0d121b] dark:text-white">Note (0-20) *</label>
                    <input type="number" name="note" min="0" max="20" step="0.5"
                           class="w-full rounded-lg border border-[#e7ebf3] dark:border-gray-700 bg-white dark:bg-[#111827] px-4 py-3 text-[#0d121b] dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           required>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <button type="submit" class="px-6 py-2.5 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm transition">
                    Ajouter la note
                </button>
                <button type="reset" class="px-6 py-2.5 rounded-lg bg-gray-100 dark:bg-gray-700 text-[#0d121b] dark:text-white font-bold text-sm hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                    Réinitialiser
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.querySelectorAll('.tab-button').forEach(button => {
        button.addEventListener('click', function() {
            const tabName = this.dataset.tab;

            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.add('hidden');
            });

            document.querySelectorAll('.tab-button').forEach(btn => {
                btn.classList.remove('text-blue-600', 'border-blue-600');
                btn.classList.add('text-[#4c669a]', 'dark:text-gray-400', 'border-transparent');
            });

            document.getElementById('tab-' + tabName).classList.remove('hidden');

            this.classList.remove('text-[#4c669a]', 'dark:text-gray-400', 'border-transparent');
            this.classList.add('text-blue-600', 'border-blue-600');
        });
    });
</script>
@endsection
