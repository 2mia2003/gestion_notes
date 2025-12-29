@extends('filiere&module_dessine.bar-export')

@section('title', 'Gestion des Semestres')

@php($tab = 'semestres')

@section('page_actions')
    <a href="{{ route('semestre.index', ['create' => 1]) }}" class="flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg bg-primary text-white font-bold text-sm shadow-lg shadow-primary/25 hover:bg-primary-hover transition-all">
        <span class="material-symbols-outlined text-[20px]">add</span>
        Nouveau Semestre
    </a>
@endsection

@section('tab_content')
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <!-- Left: Semestres list -->
        <div class="lg:col-span-8 flex flex-col gap-4">
            <div class="overflow-hidden rounded-xl border border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="border-b border-border-light dark:border-border-dark bg-background-light/50 dark:bg-slate-800/50">
                            <tr>
                                <th class="px-6 py-4 font-semibold text-text-sec-light dark:text-text-sec-dark w-[90px]">Code</th>
                                <th class="px-6 py-4 font-semibold text-text-sec-light dark:text-text-sec-dark">Semestre</th>
                                <th class="px-6 py-4 font-semibold text-text-sec-light dark:text-text-sec-dark">Année</th>
                                <th class="px-6 py-4 font-semibold text-text-sec-light dark:text-text-sec-dark">Dates</th>
                                <th class="px-6 py-4 font-semibold text-text-sec-light dark:text-text-sec-dark text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border-light dark:divide-border-dark">
                            @foreach($semestres as $sem)
                                @php($isSelected = $selected && $selected->id === $sem->id)
                                <tr class="group hover:bg-primary/5 transition-colors cursor-pointer border-l-4 {{ $isSelected ? 'bg-primary/5 border-l-primary' : 'border-l-transparent hover:border-l-primary' }}"
                                    onclick="window.location='{{ route('semestre.index', ['semestre' => $sem->id]) }}'">
                                    <td class="px-6 py-4 font-mono font-medium text-text-sec-light dark:text-text-sec-dark">{{ $sem->code }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-text-main-light dark:text-text-main-dark">{{ $sem->nom }}</span>
                                            <span class="text-xs text-text-sec-light dark:text-text-sec-dark">ID #{{ $sem->id }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">{{ optional($sem->anneeAcademique)->libelle ?? '—' }}</td>
                                    <td class="px-6 py-4">{{ $sem->date_debut }} → {{ $sem->date_fin }}</td>
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
                    <p class="text-xs text-text-sec-light dark:text-text-sec-dark">Total: <span class="font-medium">{{ $semestres->count() }}</span> semestres</p>
                </div>
            </div>
        </div>

        <!-- Right: Details / Form -->
        <div class="lg:col-span-4">
            <div class="sticky top-24 rounded-xl border border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark shadow-lg">
                <div class="flex items-center justify-between border-b border-border-light dark:border-border-dark px-6 py-4">
                    <div>
                        <h3 class="font-bold text-text-main-light dark:text-text-main-dark">{{ $creating ? 'Nouveau Semestre' : 'Détails Semestre' }}</h3>
                        <p class="text-xs text-text-sec-light dark:text-text-sec-dark">
                            @if(!$creating && $selected)
                                {{ $selected->code }} — {{ $selected->nom }}
                            @elseif($creating)
                                Remplissez le formulaire pour créer un semestre
                            @else
                                Sélectionnez un semestre à gauche
                            @endif
                        </p>
                    </div>
                    <div class="flex gap-1">
                        @if(!$creating && $selected)
                            <form method="POST" action="{{ route('semestre.destroy', $selected) }}" onsubmit="return confirm('Supprimer ce semestre ?');">
                                @csrf
                                @method('DELETE')
                                <button class="rounded-md p-1.5 text-text-sec-light hover:bg-background-light dark:hover:bg-slate-800 hover:text-red-500 transition-colors" title="Supprimer">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </form>
                        @endif
                        <a href="{{ route('semestre.index') }}" class="rounded-md p-1.5 text-text-sec-light hover:bg-background-light dark:hover:bg-slate-800 transition-colors" title="Fermer">
                            <span class="material-symbols-outlined text-[20px]">close</span>
                        </a>
                    </div>
                </div>

                <div class="p-6 space-y-5">
                    @if(session('status'))
                        <div class="rounded-md bg-green-50 text-green-700 text-xs font-bold px-3 py-2">{{ session('status') }}</div>
                    @endif
                    @if($creating || $selected)
                        <form method="POST" action="{{ $creating ? route('semestre.store') : route('semestre.update', $selected) }}" class="space-y-4">
                            @csrf
                            @if(!$creating)
                                @method('PUT')
                            @endif

                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label class="text-xs font-bold text-text-sec-light dark:text-text-sec-dark uppercase tracking-wide">Code</label>
                                    <input name="code" class="w-full rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-slate-800 text-sm font-medium" type="text" value="{{ old('code', $selected->code ?? '') }}" required/>
                                    @error('code')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-xs font-bold text-text-sec-light dark:text-text-sec-dark uppercase tracking-wide">Nom</label>
                                    <input name="nom" class="w-full rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-slate-800 text-sm font-medium" type="text" value="{{ old('nom', $selected->nom ?? '') }}" required/>
                                    @error('nom')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label class="text-xs font-bold text-text-sec-light dark:text-text-sec-dark uppercase tracking-wide">Année académique</label>
                                    @php($pref = old('annee_academique_id', $selected->annee_academique_id ?? session('new_annee_id')))
                                    <select name="annee_academique_id" class="w-full rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-slate-800 text-sm font-medium" required>
                                        @if($annees->isEmpty())
                                            <option value="" disabled selected>Aucune année active disponible</option>
                                        @else
                                            @foreach($annees as $an)
                                                <option value="{{ $an->id }}" {{ (string)$pref === (string)$an->id ? 'selected' : '' }}>
                                                    {{ $an->libelle }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('annee_academique_id')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                                    @if($annees->isEmpty())
                                        <div class="mt-2 text-xs text-text-sec-light dark:text-text-sec-dark">
                                            <p>Aucune année active. Utilisez le bloc "Gestion des années" ci-dessous.</p>
                                        </div>
                                    @endif
                                    <div class="mt-2 flex flex-wrap items-center gap-2">
                                        <input form="anneeCreateForm" name="libelle" type="text" class="w-full md:w-auto flex-1 min-w-[160px] rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-slate-800 text-sm font-medium break-words" placeholder="Ex: 2025-2026" value="{{ old('libelle') }}" required>
                                        <label class="flex items-center gap-1 text-xs text-text-sec-light shrink-0">
                                            <input form="anneeCreateForm" type="checkbox" name="active" value="1" class="rounded border-border-light" checked> Activer
                                        </label>
                                        <button form="anneeCreateForm" type="submit" class="shrink-0 rounded-md bg-primary px-3 py-1.5 text-xs font-bold text-white hover:bg-primary-hover">Ajouter</button>
                                        @error('libelle')<p class="text-xs text-red-500 w-full">{{ $message }}</p>@enderror
                                    </div>
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-xs font-bold text-text-sec-light dark:text-text-sec-dark uppercase tracking-wide">Dates</label>
                                    <div class="grid grid-cols-2 gap-2">
                                        <input name="date_debut" type="date" class="w-full rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-slate-800 text-sm font-medium" value="{{ old('date_debut', $selected->date_debut ?? '') }}" required>
                                        <input name="date_fin" type="date" class="w-full rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-slate-800 text-sm font-medium" value="{{ old('date_fin', $selected->date_fin ?? '') }}" required>
                                    </div>
                                    @error('date_debut')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                                    @error('date_fin')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div class="flex items-center justify-end gap-3 border-t border-border-light dark:border-border-dark bg-background-light/50 dark:bg-slate-800/50 px-0 py-4 rounded-b-xl">
                                <a href="{{ route('semestre.index') }}" class="px-4 py-2 text-sm font-bold text-text-sec-light hover:text-text-main-light dark:hover:text-white transition-colors">Annuler</a>
                                <button class="rounded-lg bg-primary px-6 py-2 text-sm font-bold text-white shadow-lg shadow-primary/20 hover:bg-primary-hover transition-all">Enregistrer</button>
                            </div>
                        </form>
                        <!-- Hidden external form to create an academic year; used by inputs with form="anneeCreateForm" -->
                        <form id="anneeCreateForm" method="POST" action="{{ route('annee-academique.store') }}" class="hidden">
                            @csrf
                        </form>
                    @else
                        <p class="text-sm text-text-sec-light">Aucun semestre sélectionné.</p>
                    @endif
                </div>
                @isset($anneesAll)
                <div class="px-6 pb-6">
                    <div class="rounded-xl border border-border-light dark:border-border-dark bg-background-light/50 dark:bg-slate-800/50 p-4">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="text-sm font-bold text-text-main-light dark:text-text-main-dark">Gestion des années académiques</h4>
                        </div>
                        <form method="POST" action="{{ route('annee-academique.store') }}" class="flex flex-wrap items-center gap-2 mb-3">
                            @csrf
                            <input name="libelle" type="text" class="w-full md:w-auto flex-1 min-w-[160px] rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-slate-800 text-sm font-medium" placeholder="Ex: 2025-2026" value="{{ old('libelle') }}" required>
                            <label class="flex items-center gap-1 text-xs text-text-sec-light shrink-0">
                                <input type="checkbox" name="active" value="1" class="rounded border-border-light" checked> Activer
                            </label>
                            <button type="submit" class="shrink-0 rounded-md bg-primary px-3 py-1.5 text-xs font-bold text-white hover:bg-primary-hover">Ajouter</button>
                            @error('libelle')<p class="text-xs text-red-500 w-full">{{ $message }}</p>@enderror
                        </form>
                        <ul class="space-y-1">
                            @forelse($anneesAll as $an)
                                <li class="flex items-center justify-between text-xs">
                                    <span class="flex items-center gap-2">
                                        {{ $an->libelle }}
                                        @if($an->active)
                                            <span class="inline-flex items-center rounded bg-green-100 text-green-700 px-1.5 py-0.5">Active</span>
                                        @endif
                                    </span>
                                    @if(!$an->active)
                                        <form method="POST" action="{{ route('annee-academique.set-active', $an) }}">
                                            @csrf
                                            <button class="text-primary hover:underline">Définir active</button>
                                        </form>
                                    @endif
                                </li>
                            @empty
                                <li class="text-xs text-text-sec-light">Aucune année enregistrée.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
                @endisset
            </div>
        </div>
    </div>
@endsection
