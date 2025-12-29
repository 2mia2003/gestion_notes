@extends('filiere&module_dessine.bar-export')

@section('title', 'Gestion des Modules')

@php($tab = 'modules')

@section('page_actions')
    <a href="{{ route('module.index', ['create' => 1]) }}" class="flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg bg-primary text-white font-bold text-sm shadow-lg shadow-primary/25 hover:bg-primary-hover transition-all">
        <span class="material-symbols-outlined text-[20px]">add</span>
        Nouveau Module
    </a>
@endsection

@section('tab_content')
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <!-- Left: Modules list -->
        <div class="lg:col-span-8 flex flex-col gap-4">
            <!-- Toolbar (same as Filière) -->
            <div class="flex flex-wrap items-center justify-between gap-4 p-1 rounded-xl">
                <label class="relative flex-1 min-w-[280px]">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-text-sec-light dark:text-text-sec-dark">
                        <span class="material-symbols-outlined">search</span>
                    </span>
                    <input class="w-full rounded-lg border-none bg-card-light dark:bg-card-dark py-2.5 pl-10 pr-4 text-sm font-medium text-text-main-light dark:text-text-main-dark placeholder-text-sec-light dark:placeholder-text-sec-dark shadow-sm ring-1 ring-border-light dark:ring-border-dark focus:ring-2 focus:ring-primary" placeholder="Rechercher par code, nom ou responsable..." type="text"/>
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
            <div class="overflow-hidden rounded-xl border border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="border-b border-border-light dark:border-border-dark bg-background-light/50 dark:bg-slate-800/50">
                            <tr>
                                <th class="px-6 py-4 font-semibold text-text-sec-light dark:text-text-sec-dark w-[90px]">Code</th>
                                <th class="px-6 py-4 font-semibold text-text-sec-light dark:text-text-sec-dark">Module</th>
                                <th class="px-6 py-4 font-semibold text-text-sec-light dark:text-text-sec-dark">Niveau</th>
                                <th class="px-6 py-4 font-semibold text-text-sec-light dark:text-text-sec-dark">Semestre</th>
                                <th class="px-6 py-4 font-semibold text-text-sec-light dark:text-text-sec-dark">Statut</th>
                                <th class="px-6 py-4 font-semibold text-text-sec-light dark:text-text-sec-dark">Responsable</th>
                                <th class="px-6 py-4 font-semibold text-text-sec-light dark:text-text-sec-dark text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border-light dark:divide-border-dark">
                            @foreach($modules as $mod)
                                @php($isSelected = $selected && $selected->id === $mod->id)
                                <tr class="group hover:bg-primary/5 transition-colors cursor-pointer border-l-4 {{ $isSelected ? 'bg-primary/5 border-l-primary' : 'border-l-transparent hover:border-l-primary' }}"
                                    onclick="window.location='{{ route('module.index', ['module' => $mod->id]) }}'">
                                    <td class="px-6 py-4 font-mono font-medium text-text-sec-light dark:text-text-sec-dark">{{ $mod->code }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-text-main-light dark:text-text-main-dark">{{ $mod->nom }}</span>
                                            <span class="text-xs text-text-sec-light dark:text-text-sec-dark">ID #{{ $mod->id }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">{{ optional($mod->niveau)->code ?? '—' }}</td>
                                    <td class="px-6 py-4">{{ optional($mod->semestre)->code ?? '—' }}</td>
                                    <td class="px-6 py-4">
                                        @php($st = $mod->statut ?? 'en_attente')
                                        @switch($st)
                                            @case('actif')
                                                <span class="inline-flex items-center rounded bg-green-100 text-green-700 px-2 py-0.5 text-xs font-bold">Actif</span>
                                                @break
                                            @case('inactif')
                                                <span class="inline-flex items-center rounded bg-gray-200 text-gray-700 px-2 py-0.5 text-xs font-bold">Inactif</span>
                                                @break
                                            @default
                                                <span class="inline-flex items-center rounded bg-yellow-100 text-yellow-800 px-2 py-0.5 text-xs font-bold">En attente</span>
                                        @endswitch
                                    </td>
                                    <td class="px-6 py-4">{{ optional($mod->responsable)->name ?? '—' }}</td>
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
                    <p class="text-xs text-text-sec-light dark:text-text-sec-dark">Total: <span class="font-medium">{{ $modules->count() }}</span> modules</p>
                </div>
            </div>
        </div>

        <!-- Right: Details / Form -->
        <div class="lg:col-span-4">
            <div class="sticky top-24 rounded-xl border border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark shadow-lg">
                <div class="flex items-center justify-between border-b border-border-light dark:border-border-dark px-6 py-4">
                    <div>
                        <h3 class="font-bold text-text-main-light dark:text-text-main-dark">{{ $creating ? 'Nouveau Module' : 'Détails Module' }}</h3>
                        <p class="text-xs text-text-sec-light dark:text-text-sec-dark">
                            @if(!$creating && $selected)
                                {{ $selected->code }} — {{ $selected->nom }}
                            @elseif($creating)
                                Remplissez le formulaire pour créer un module
                            @else
                                Sélectionnez un module à gauche
                            @endif
                        </p>
                    </div>
                    <div class="flex gap-1">
                        @if(!$creating && $selected)
                            <form method="POST" action="{{ route('module.destroy', $selected) }}" onsubmit="return confirm('Supprimer ce module ?');">
                                @csrf
                                @method('DELETE')
                                <button class="rounded-md p-1.5 text-text-sec-light hover:bg-background-light dark:hover:bg-slate-800 hover:text-red-500 transition-colors" title="Supprimer">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </form>
                        @endif
                        <a href="{{ route('module.index') }}" class="rounded-md p-1.5 text-text-sec-light hover:bg-background-light dark:hover:bg-slate-800 transition-colors" title="Fermer">
                            <span class="material-symbols-outlined text-[20px]">close</span>
                        </a>
                    </div>
                </div>

                <div class="p-6 space-y-5">
                    @if($creating || $selected)
                        <form method="POST" action="{{ $creating ? route('module.store') : route('module.update', $selected) }}" class="space-y-4">
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
                                    <label class="text-xs font-bold text-text-sec-light dark:text-text-sec-dark uppercase tracking-wide">Niveau</label>
                                    <select name="niveau_id" class="w-full rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-slate-800 text-sm font-medium" required>
                                        @foreach($niveaux as $niv)
                                            <option value="{{ $niv->id }}" {{ (string)old('niveau_id', $selected->niveau_id ?? '') === (string)$niv->id ? 'selected' : '' }}>
                                                {{ $niv->code }} — {{ $niv->nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('niveau_id')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-xs font-bold text-text-sec-light dark:text-text-sec-dark uppercase tracking-wide">Semestre</label>
                                    <select name="semestre_id" class="w-full rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-slate-800 text-sm font-medium" required>
                                        @foreach($semestres as $sem)
                                            <option value="{{ $sem->id }}" {{ (string)old('semestre_id', $selected->semestre_id ?? '') === (string)$sem->id ? 'selected' : '' }}>
                                                {{ $sem->code }} — {{ $sem->nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('semestre_id')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label class="text-xs font-bold text-text-sec-light dark:text-text-sec-dark uppercase tracking-wide">Statut</label>
                                    <select name="statut" class="w-full rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-slate-800 text-sm font-medium" required>
                                        @php($cur = old('statut', $selected->statut ?? 'en_attente'))
                                        <option value="en_attente" {{ $cur === 'en_attente' ? 'selected' : '' }}>En attente</option>
                                        <option value="actif" {{ $cur === 'actif' ? 'selected' : '' }}>Actif</option>
                                        <option value="inactif" {{ $cur === 'inactif' ? 'selected' : '' }}>Inactif</option>
                                    </select>
                                    @error('statut')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label class="text-xs font-bold text-text-sec-light dark:text-text-sec-dark uppercase tracking-wide">Responsable</label>
                                    <select name="responsable_user_id" class="w-full rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-slate-800 text-sm font-medium">
                                        <option value="">—</option>
                                        @foreach($users as $u)
                                            <option value="{{ $u->id }}" {{ (string)old('responsable_user_id', $selected->responsable_user_id ?? '') === (string)$u->id ? 'selected' : '' }}>{{ $u->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('responsable_user_id')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-xs font-bold text-text-sec-light dark:text-text-sec-dark uppercase tracking-wide">Crédits</label>
                                    <input name="credits" class="w-full rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-slate-800 text-sm font-medium" type="number" min="0" max="30" value="{{ old('credits', $selected->credits ?? '') }}"/>
                                    @error('credits')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div class="flex items-center justify-end gap-3 border-t border-border-light dark:border-border-dark bg-background-light/50 dark:bg-slate-800/50 px-0 py-4 rounded-b-xl">
                                <a href="{{ route('module.index') }}" class="px-4 py-2 text-sm font-bold text-text-sec-light hover:text-text-main-light dark:hover:text-white transition-colors">Annuler</a>
                                <button class="rounded-lg bg-primary px-6 py-2 text-sm font-bold text-white shadow-lg shadow-primary/20 hover:bg-primary-hover transition-all">Enregistrer</button>
                            </div>
                        </form>
                    @else
                        <p class="text-sm text-text-sec-light">Aucun module sélectionné.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
