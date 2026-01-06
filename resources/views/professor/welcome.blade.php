@extends('layouts.app')

@section('title', 'Accueil - Professeur')
@section('breadcrumb', 'Professeur / Accueil')

@section('content')
<div class="space-y-6">
    <!-- En-tête de bienvenue -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-xl p-8 shadow-lg text-white">
        <h1 class="text-4xl font-bold mb-2">Bienvenue, {{ auth()->user()->name }}</h1>
        <p class="text-blue-100 text-lg">Tableau de bord enseignant</p>
    </div>

    <!-- Statistiques des modules -->
    @if(count($moduleStats) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($moduleStats as $stat)
                <div class="bg-white dark:bg-[#1a2230] rounded-xl border border-[#e7ebf3] dark:border-gray-800 p-6 shadow-sm hover:shadow-lg transition">
                    <!-- En-tête du module -->
                    <div class="mb-6">
                        <p class="text-xs font-bold text-blue-600 dark:text-blue-400 uppercase tracking-wide">{{ $stat['code'] }}</p>
                        <h3 class="text-lg font-bold text-[#0d121b] dark:text-white mt-1">{{ $stat['nom'] }}</h3>
                        <p class="text-sm text-[#4c669a] dark:text-gray-400 mt-1">{{ $stat['niveau'] }}</p>
                    </div>

                    <!-- Statistiques -->
                    <div class="space-y-4 mb-8">
                        <div class="flex items-center justify-between p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                            <span class="text-sm text-[#4c669a] dark:text-gray-400 font-bold">Total d'étudiants</span>
                            <span class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $stat['totalStudents'] }}</span>
                        </div>

                        <div class="flex items-center justify-between p-3 bg-green-50 dark:bg-green-900/20 rounded-lg">
                            <span class="text-sm text-[#4c669a] dark:text-gray-400 font-bold">Avec notes</span>
                            <span class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $stat['studentsWithNotes'] }}</span>
                        </div>

                        <div class="flex items-center justify-between p-3 bg-orange-50 dark:bg-orange-900/20 rounded-lg">
                            <span class="text-sm text-[#4c669a] dark:text-gray-400 font-bold">Sans notes</span>
                            <span class="text-2xl font-bold text-orange-600 dark:text-orange-400">{{ $stat['studentsWithoutNotes'] }}</span>
                        </div>
                    </div>

                    <!-- Barre de progression -->
                    <div class="mb-6">
                        @php
                            $percentage = $stat['totalStudents'] > 0 
                                ? round(($stat['studentsWithNotes'] / $stat['totalStudents']) * 100) 
                                : 0;
                        @endphp
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-bold text-[#4c669a] dark:text-gray-400">Progression</span>
                            <span class="text-xs font-bold text-[#0d121b] dark:text-white">{{ $percentage }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full transition-all" style="width: {{ $percentage }}%"></div>
                        </div>
                    </div>

                    <!-- Actions rapides -->
                    <div class="flex gap-2">
                        <a href="{{ route('professor.dashboard') }}" 
                           class="flex-1 text-center px-4 py-2 rounded-lg bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-300 font-bold text-sm hover:bg-blue-200 dark:hover:bg-blue-900/50 transition-all cursor-pointer block">
                            Tableau de bord
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white dark:bg-[#1a2230] rounded-xl border border-[#e7ebf3] dark:border-gray-800 p-12 shadow-sm text-center">
            <svg class="w-16 h-16 text-[#d9e5ef] dark:text-gray-700 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
            </svg>
            <p class="text-[#4c669a] dark:text-gray-400 font-semibold">Aucun module attribué</p>
            <p class="text-sm text-[#4c669a] dark:text-gray-500 mt-1">Contactez l'administrateur pour vous assigner des modules.</p>
        </div>
    @endif

    <!-- Section Actions principales -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Tableau de bord -->
        <a href="{{ route('professor.dashboard') }}" 
           class="block bg-white dark:bg-[#1a2230] rounded-xl border border-[#e7ebf3] dark:border-gray-800 p-6 shadow-sm hover:shadow-lg transition-all cursor-pointer">
            <div class="flex items-start justify-between mb-4">
                <div class="w-12 h-12 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center hover:bg-blue-200 dark:hover:bg-blue-900/50 transition-all">
                    <span class="material-symbols-outlined text-blue-600 dark:text-blue-400">people</span>
                </div>
            </div>
            <h3 class="text-lg font-bold text-[#0d121b] dark:text-white mb-2">Tableau de bord</h3>
            <p class="text-sm text-[#4c669a] dark:text-gray-400 mb-4">Consultez la liste complète de vos étudiants et leurs notes actuelles.</p>
            <span class="text-sm font-bold text-blue-600 dark:text-blue-400 inline-flex items-center gap-2">
                Accéder <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </span>
        </a>

        <!-- Importation des notes -->
        <a href="{{ route('professor.dashboard') }}#tab-import" 
           class="bg-white dark:bg-[#1a2230] rounded-xl border border-[#e7ebf3] dark:border-gray-800 p-6 shadow-sm hover:shadow-lg transition group">
            <div class="flex items-start justify-between mb-4">
                <div class="w-12 h-12 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center group-hover:bg-green-200 dark:group-hover:bg-green-900/50 transition">
                    <span class="material-symbols-outlined text-green-600 dark:text-green-400">upload_file</span>
                </div>
            </div>
            <h3 class="text-lg font-bold text-[#0d121b] dark:text-white mb-2">Importation des notes</h3>
            <p class="text-sm text-[#4c669a] dark:text-gray-400 mb-4">Importez les notes en masse via CSV ou ajoutez des notes individuellement.</p>
            <span class="text-sm font-bold text-green-600 dark:text-green-400 inline-flex items-center gap-2">
                Accéder <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </span>
        </a>
    </div>

    <!-- Infos rapides -->
    <div class="bg-blue-50 dark:bg-blue-900/20 rounded-xl border border-blue-200 dark:border-blue-800 p-6">
        <h3 class="text-sm font-bold text-blue-700 dark:text-blue-300 mb-3">💡 Conseils</h3>
        <ul class="text-sm text-blue-600 dark:text-blue-400 space-y-2">
            <li>✓ Accédez au "Tableau de bord" pour voir tous vos étudiants et leurs notes</li>
            <li>✓ Utilisez "Importation des notes" pour charger des notes en masse ou en ajouter manuellement</li>
            <li>✓ Les statistiques ci-dessus se mettent à jour automatiquement quand vous ajoutez des notes</li>
        </ul>
    </div>
</div>
@endsection
