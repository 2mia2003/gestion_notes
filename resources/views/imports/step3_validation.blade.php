@extends('importdessine.ocr')
@section('title', 'Nouvelle Importation - Validation')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-3xl font-black">Validation</h1>
    <button class="rounded-lg bg-primary px-6 py-2.5 text-sm font-bold text-white">Valider & Enregistrer</button>
</div>

<div class="rounded-xl border border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark p-6 shadow-sm">
    <p class="text-text-sec-light dark:text-text-sec-dark">
        Ici tu mettras le résumé (erreurs, doublons, notes hors bornes) + confirmation.
    </p>
</div>
@endsection
