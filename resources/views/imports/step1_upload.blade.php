@extends('importdessine.ocr')

@section('title', 'Nouvelle Importation - Upload')

@section('content')

{{-- Titre + Steps --}}
<div class="flex flex-col gap-2 mb-6">
    <div class="flex items-center justify-between gap-6 flex-wrap">
        <div>
            <h1 class="text-3xl font-black tracking-tight">Nouvelle Importation</h1>
            <p class="text-text-sec-light dark:text-text-sec-dark mt-1">Numérisez, taguez et archivez les feuilles de notes.</p>
        </div>

        <div class="flex items-center gap-3 text-sm font-semibold">
            <div class="flex items-center gap-2">
                <span class="inline-flex size-8 items-center justify-center rounded-full bg-primary text-white">1</span>
                <span class="text-primary">Upload</span>
            </div>
            <span class="h-px w-10 bg-border-light dark:bg-border-dark"></span>
            <div class="flex items-center gap-2 opacity-60">
                <span class="inline-flex size-8 items-center justify-center rounded-full bg-slate-200 dark:bg-slate-700">2</span>
                <span>Détails</span>
            </div>
            <span class="h-px w-10 bg-border-light dark:bg-border-dark"></span>
            <div class="flex items-center gap-2 opacity-60">
                <span class="inline-flex size-8 items-center justify-center rounded-full bg-slate-200 dark:bg-slate-700">3</span>
                <span>Validation</span>
            </div>
        </div>
    </div>
</div>

{{-- Contenu de l'étape 1 (placeholder maquette) --}}
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
    <div class="lg:col-span-7 rounded-xl border border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-bold">Documents source</h2>
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center rounded-lg bg-primary/10 text-primary px-3 py-1 text-sm font-bold">OCR AUTO</span>
                <span class="material-symbols-outlined text-text-sec-light">info</span>
            </div>
        </div>

        <div class="border-2 border-dashed border-border-light dark:border-border-dark rounded-xl p-10 text-center bg-background-light/50 dark:bg-slate-800/30">
            <div class="mx-auto mb-4 flex size-16 items-center justify-center rounded-full bg-primary/10 text-primary">
                <span class="material-symbols-outlined text-3xl">cloud_upload</span>
            </div>
            <p class="text-xl font-black">Glissez vos fichiers ici</p>
            <p class="text-text-sec-light dark:text-text-sec-dark mt-1">ou cliquez pour parcourir votre ordinateur</p>
        </div>

        <div class="mt-6 flex justify-end gap-3">
            <a href="{{ route('imports.step2') }}"
               class="rounded-lg bg-primary px-6 py-2.5 text-sm font-bold text-white shadow-lg shadow-primary/20 hover:bg-primary-hover transition-all">
                Continuer
            </a>
        </div>
    </div>

    <div class="lg:col-span-5 rounded-xl border border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark p-6 shadow-sm">
        <h2 class="text-lg font-bold">Catégorisation</h2>
        <p class="text-text-sec-light dark:text-text-sec-dark text-sm mt-1">Ces informations seront liées aux notes extraites.</p>

        <div class="mt-6 space-y-4">
            <div>
                <label class="text-xs font-bold uppercase tracking-wide text-text-sec-light dark:text-text-sec-dark">Département</label>
                <select class="mt-2 w-full rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-slate-800">
                    <option>Sélectionner un département</option>
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-xs font-bold uppercase tracking-wide text-text-sec-light dark:text-text-sec-dark">Filière</label>
                    <select class="mt-2 w-full rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-slate-800">
                        <option>Filière</option>
                    </select>
                </div>
                <div>
                    <label class="text-xs font-bold uppercase tracking-wide text-text-sec-light dark:text-text-sec-dark">Semestre</label>
                    <select class="mt-2 w-full rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-slate-800">
                        <option>S1</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="text-xs font-bold uppercase tracking-wide text-text-sec-light dark:text-text-sec-dark">Module</label>
                <select class="mt-2 w-full rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-slate-800">
                    <option>Choisir un module</option>
                </select>
            </div>

            <div>
                <label class="text-xs font-bold uppercase tracking-wide text-text-sec-light dark:text-text-sec-dark">Année académique</label>
                <select class="mt-2 w-full rounded-lg border-border-light dark:border-border-dark bg-background-light dark:bg-slate-800">
                    <option>2025-2026</option>
                </select>
            </div>
        </div>
    </div>
</div>

@endsection
