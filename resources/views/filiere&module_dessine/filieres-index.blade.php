@extends('filiere&module_dessine.bar-export')

@section('title', 'Gestion des Filières')

@php($tab = 'filieres')

@section('page_actions')
    <a href="{{ route('filiere.index', ['create' => 1]) }}" class="flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg bg-primary text-white font-bold text-sm shadow-lg shadow-primary/25 hover:bg-primary-hover transition-all">
        <span class="material-symbols-outlined text-[20px]">add</span>
        Nouvelle Filière
    </a>
@endsection

@section('tab_content')
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <!-- Left: Filières list -->
        <div class="lg:col-span-8 flex flex-col gap-4">
            <!-- Toolbar -->
            <div class="flex flex-wrap items-center justify-between gap-4 p-1 rounded-xl">
                <label class="relative flex-1 min-w-[280px]">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-text-sec-light dark:text-text-sec-dark">
                        <span class="material-symbols-outlined">search</span>
                    </span>
                    <input class="w-full rounded-lg border-none bg-card-light dark:bg-card-dark py-2.5 pl-10 pr-4 text-sm font-medium text-text-main-light dark:text-text-main-dark placeholder-text-sec-light dark:placeholder-text-sec-dark shadow-sm ring-1 ring-border-light dark:ring-border-dark focus:ring-2 focus:ring-primary" placeholder="Rechercher par code, nom ou département..." type="text"/>
                </label>
                <div class="flex items-center gap-2">
                    <button class="flex items-center gap-2 px-3 py-2 text-sm font-medium text-text-sec-light dark:text-text-sec-dark bg-card-light dark:bg-card-dark rounded-lg ring-1 ring-border-light dark:ring-border-dark hover:bg-background-light dark:hover:bg-slate-800">
                        <span class="material-symbols-outlined text-[18px]">filter_list</span>
                        Filtres
                    </button>
                    <button class="flex items-center gap-2 px-3 py-2 text-sm font-medium text-text-sec-light dark:text-text-sec-dark bg-card-light dark:bg-card-dark rounded-lg ring-1 ring-border-light dark:ring-border-dark hover:bg-background-light dark:hover:bg-slate-800">
                        <span class="material-symbols-outlined text-[18px]">sort</span>
                        Trier
                    </button>
                </div>
            </div>

            <!-- Filières Table -->
            <div class="overflow-hidden rounded-xl border border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="border-b border-border-light dark:border-border-dark bg-background-light/50 dark:bg-slate-800/50">
                            <tr>
                                <th class="px-6 py-4 font-semibold text-text-sec-light dark:text-text-sec-dark w-[90px]">Code</th>
                                <th class="px-6 py-4 font-semibold text-text-sec-light dark:text-text-sec-dark">Filière</th>
                                <th class="px-6 py-4 font-semibold text-text-sec-light dark:text-text-sec-dark">Département</th>
                                <th class="px-6 py-4 font-semibold text-text-sec-light dark:text-text-sec-dark">Niveaux</th>
                                <th class="px-6 py-4 font-semibold text-text-sec-light dark:text-text-sec-dark text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border-light dark:divide-border-dark">
                            @foreach($filieres as $fil)
                                @php($isSelected = $selected && $selected->id === $fil->id)
                                <tr class="group hover:bg-primary/5 transition-colors cursor-pointer border-l-4 {{ $isSelected ? 'bg-primary/5 border-l-primary' : 'border-l-transparent hover:border-l-primary' }}"
                                    onclick="window.location='{{ route('filiere.index', ['filiere' => $fil->id]) }}'">
                                    <td class="px-6 py-4 font-mono font-medium text-text-sec-light dark:text-text-sec-dark">{{ $fil->code }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-text-main-light dark:text-text-main-dark">{{ $fil->nom }}</span>
                                            <span class="text-xs text-text-sec-light dark:text-text-sec-dark">ID #{{ $fil->id }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-sm font-medium">{{ optional($fil->departement)->nom ?? '—' }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center rounded-md bg-slate-100 dark:bg-slate-800 px-2 py-1 text-xs font-medium text-slate-600 dark:text-slate-400 ring-1 ring-inset ring-slate-500/10">{{ $fil->niveaux_count }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <button class="text-text-sec-light dark:text-text-sec-dark hover:text-primary transition-colors">
                                            <span class="material-symbols-outlined text-[20px]">more_vert</span>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="flex items-center justify-between border-t border-border-light dark:border-border-dark bg-background-light/50 dark:bg-slate-800/50 px-6 py-3">
                    <p class="text-xs text-text-sec-light dark:text-text-sec-dark">
                        Total: <span class="font-medium">{{ $filieres->count() }}</span> filières
                    </p>
                </div>
            </div>

            <!-- Création rapide d'un département -->
            <div class="rounded-xl border border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark shadow-sm">
                <form method="POST" action="{{ route('departement.store') }}" class="p-4 grid grid-cols-1 sm:grid-cols-3 gap-3 items-end">
                    @csrf
                    <div>
                        <label class="text-xs font-bold text-text-sec-light dark:text-text-sec-dark uppercase tracking-wide">Code Dépt.</label>
                        <input name="code" class="w-full rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-slate-800 text-sm font-medium" type="text" value="{{ old('code') }}" placeholder="INF" required>
                        @error('code')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="text-xs font-bold text-text-sec-light dark:text-text-sec-dark uppercase tracking-wide">Nom Dépt.</label>
                        <input name="nom" class="w-full rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-slate-800 text-sm font-medium" type="text" value="{{ old('nom') }}" placeholder="Informatique" required>
                        @error('nom')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <button class="w-full sm:w-auto rounded-lg bg-primary px-6 py-2 text-sm font-bold text-white shadow-lg shadow-primary/20 hover:bg-primary-hover transition-all">Ajouter Département</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right: Details -->
        <div class="lg:col-span-4">
            <div class="sticky top-24 rounded-xl border border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark shadow-lg">
                <div class="flex items-center justify-between border-b border-border-light dark:border-border-dark px-6 py-4">
                    <div>
                        <h3 class="font-bold text-text-main-light dark:text-text-main-dark">{{ $creating ? 'Nouvelle Filière' : 'Détails Filière' }}</h3>
                        <p class="text-xs text-text-sec-light dark:text-text-sec-dark">
                            @if(!$creating && $selected)
                                {{ $selected->code }} — {{ $selected->nom }}
                            @elseif($creating)
                                Remplissez le formulaire pour créer une filière
                            @else
                                Sélectionnez une filière à gauche
                            @endif
                        </p>
                    </div>
                    <div class="flex gap-1">
                        @if(!$creating && $selected)
                            <form method="POST" action="{{ route('filiere.destroy', $selected) }}" onsubmit="return confirm('Supprimer cette filière ?');">
                                @csrf
                                @method('DELETE')
                                <button class="rounded-md p-1.5 text-text-sec-light hover:bg-background-light dark:hover:bg-slate-800 hover:text-red-500 transition-colors" title="Supprimer">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </form>
                        @endif
                        <a href="{{ route('filiere.index') }}" class="rounded-md p-1.5 text-text-sec-light hover:bg-background-light dark:hover:bg-slate-800 transition-colors" title="Fermer">
                            <span class="material-symbols-outlined text-[20px]">close</span>
                        </a>
                    </div>
                </div>

                <div class="p-6 space-y-5">
                    @if($creating || $selected)
                        <form method="POST" action="{{ $creating ? route('filiere.store') : route('filiere.update', $selected) }}" class="space-y-4">
                            @csrf
                            @if(!$creating)
                                @method('PUT')
                            @endif

                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label class="text-xs font-bold text-text-sec-light dark:text-text-sec-dark uppercase tracking-wide">Code</label>
                                    <input name="code" class="w-full rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-slate-800 text-sm font-medium" type="text" value="{{ old('code', $selected->code ?? '') }}" {{ $creating ? '' : '' }} required/>
                                    @error('code')
                                        <p class="text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-xs font-bold text-text-sec-light dark:text-text-sec-dark uppercase tracking-wide">Département</label>
                                    <select name="departement_id" class="w-full rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-slate-800 text-sm font-medium" required>
                                        <option value="" disabled {{ old('departement_id', $selected->departement_id ?? '')==='' ? 'selected' : '' }}>Choisir...</option>
                                        @foreach($departements as $dep)
                                            <option value="{{ $dep->id }}" {{ (string)old('departement_id', $selected->departement_id ?? '') === (string)$dep->id ? 'selected' : '' }}>{{ $dep->nom }}</option>
                                        @endforeach
                                    </select>
                                    @error('departement_id')
                                        <p class="text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="space-y-1.5">
                                <label class="text-xs font-bold text-text-sec-light dark:text-text-sec-dark uppercase tracking-wide">Intitulé</label>
                                <input name="nom" class="w-full rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-slate-800 text-sm font-medium" type="text" value="{{ old('nom', $selected->nom ?? '') }}" required/>
                                @error('nom')
                                    <p class="text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex items-center justify-end gap-3 border-t border-border-light dark:border-border-dark bg-background-light/50 dark:bg-slate-800/50 px-0 py-4 rounded-b-xl">
                                <a href="{{ route('filiere.index') }}" class="px-4 py-2 text-sm font-bold text-text-sec-light hover:text-text-main-light dark:hover:text-white transition-colors">Annuler</a>
                                <button class="rounded-lg bg-primary px-6 py-2 text-sm font-bold text-white shadow-lg shadow-primary/20 hover:bg-primary-hover transition-all">Enregistrer</button>
                            </div>
                        </form>

                        @if(!$creating)
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-text-sec-light dark:text-text-sec-dark uppercase tracking-wide">Modules liés</label>
                            <div class="overflow-hidden rounded-lg border border-border-light dark:border-border-dark">
                                <table class="w-full text-left text-sm">
                                    <thead class="bg-background-light/50 dark:bg-slate-800/50">
                                        <tr>
                                            <th class="px-3 py-2">Code</th>
                                            <th class="px-3 py-2">Intitulé</th>
                                            <th class="px-3 py-2">Semestre</th>
                                            <th class="px-3 py-2">Responsable</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-border-light dark:divide-border-dark">
                                        @forelse($modules as $m)
                                            <tr>
                                                <td class="px-3 py-2 font-mono text-text-sec-light">{{ $m->code }}</td>
                                                <td class="px-3 py-2 font-medium">{{ $m->nom }}</td>
                                                <td class="px-3 py-2">{{ optional($m->semestre)->code ?? '—' }}</td>
                                                <td class="px-3 py-2">{{ optional($m->responsable)->name ?? 'Non assigné' }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="px-3 py-4 text-center text-xs text-text-sec-light">Aucun module lié</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif
                    @else
                        <p class="text-sm text-text-sec-light">Aucune filière sélectionnée.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
