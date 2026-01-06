@extends('layouts.app')

@section('title', 'Étudiants du module - ' . $module->nom)
@section('breadcrumb', 'Professeur / Étudiants')

@section('content')
<div class="space-y-6">
    <!-- En-tête avec retour -->
    <div class="flex items-center gap-4">
        <a href="{{ route('professor.dashboard') }}" class="text-blue-600 hover:text-blue-700 font-bold text-sm">
            ← Retour au tableau de bord
        </a>
    </div>

    <!-- Informations du module -->
    <div class="bg-white dark:bg-[#1a2230] rounded-xl border border-[#e7ebf3] dark:border-gray-800 p-6 shadow-sm">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs font-bold text-blue-600 dark:text-blue-400 uppercase tracking-wide">{{ $module->code }}</p>
                <h1 class="text-3xl font-bold text-[#0d121b] dark:text-white mt-1">{{ $module->nom }}</h1>
                <p class="text-[#4c669a] dark:text-gray-400 mt-2">
                    Niveau: <span class="font-bold text-[#0d121b] dark:text-white">{{ $module->niveau?->nom ?? 'N/A' }}</span> | 
                    Semestre: <span class="font-bold text-[#0d121b] dark:text-white">S{{ $module->semestre?->numero ?? 'N/A' }}</span>
                </p>
            </div>
            <span class="bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 px-4 py-2 rounded-lg font-bold text-sm">
                {{ $etudiants->count() }} étudiant{{ $etudiants->count() !== 1 ? 's' : '' }}
            </span>
        </div>
    </div>

    <!-- Tableau des étudiants -->
    <div class="bg-white dark:bg-[#1a2230] rounded-xl border border-[#e7ebf3] dark:border-gray-800 shadow-sm overflow-hidden">
        @if($etudiants->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 dark:bg-[#111827] border-b border-[#e7ebf3] dark:border-gray-800">
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#4c669a] dark:text-gray-400 uppercase tracking-wider">Matricule</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#4c669a] dark:text-gray-400 uppercase tracking-wider">Nom</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#4c669a] dark:text-gray-400 uppercase tracking-wider">Prénoms</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#4c669a] dark:text-gray-400 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#4c669a] dark:text-gray-400 uppercase tracking-wider">Notes</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#4c669a] dark:text-gray-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#e7ebf3] dark:divide-gray-800">
                        @foreach($etudiants as $etudiant)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">
                                <td class="px-6 py-4 text-sm font-bold text-[#0d121b] dark:text-white">{{ $etudiant->matricule ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm text-[#0d121b] dark:text-white">{{ $etudiant->nom }}</td>
                                <td class="px-6 py-4 text-sm text-[#0d121b] dark:text-white">{{ $etudiant->prenom }}</td>
                                <td class="px-6 py-4 text-sm text-[#4c669a] dark:text-gray-400">{{ $etudiant->email ?? '-' }}</td>
                                <td class="px-6 py-4">
                                    @php
                                        $moduleNotes = $etudiant->notes->filter(function($n) use ($module) {
                                            return $n->document && $n->document->module_id == $module->id;
                                        });
                                    @endphp
                                    @if($moduleNotes->count() > 0)
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($moduleNotes as $note)
                                                <span class="bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 px-3 py-1 rounded-full text-xs font-bold">
                                                    {{ $note->document->type }}: {{ $note->valeur ?? $note->note }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-[#4c669a] dark:text-gray-400 text-xs">Aucune note</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <button type="button" class="text-blue-600 hover:text-blue-700 font-bold text-xs transition">
                                        Ajouter une note
                                    </button>
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
                <p class="text-[#4c669a] dark:text-gray-400 font-semibold">Aucun étudiant de ce niveau</p>
                <p class="text-sm text-[#4c669a] dark:text-gray-500 mt-1">Aucun étudiant du niveau {{ $module->niveau?->nom ?? 'N/A' }} n'a été trouvé.</p>
            </div>
        @endif
    </div>

    <!-- Section d'ajout de notes -->
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
                            <option value="{{ $etudiant->id }}">{{ $etudiant->nom }} {{ $etudiant->prenom }}</option>
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
@endsection
