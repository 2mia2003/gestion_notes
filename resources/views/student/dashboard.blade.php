@extends('layouts.app')

@section('title', 'Mes Notes')
@section('breadcrumb', 'Étudiant / Mes Notes')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Header -->
    <div class="bg-white dark:bg-[#1a2230] rounded-xl border border-[#e7ebf3] dark:border-gray-800 p-6 shadow-sm mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-[#0d121b] dark:text-white">Mes Notes</h1>
                <p class="text-[#4c669a] dark:text-gray-400 mt-2">
                    Bienvenue <span class="font-semibold text-[#0d121b] dark:text-white">{{ auth()->user()->name }}</span>
                </p>
            </div>
            <a href="{{ route('student.edit-password') }}" class="flex items-center gap-2 px-4 py-2.5 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm transition">
                <span class="material-symbols-outlined text-[20px]">lock</span>
                Changer mon mot de passe
            </a>
        </div>
    </div>

    <!-- Notes Table -->
    <div class="bg-white dark:bg-[#1a2230] rounded-xl border border-[#e7ebf3] dark:border-gray-800 p-6 shadow-sm">
        <h2 class="text-2xl font-bold text-[#0d121b] dark:text-white mb-6">Mes Notes</h2>

        @if($notes->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-[#f6f8fc] dark:bg-[#111827] border-b border-[#e7ebf3] dark:border-gray-700">
                            <th class="px-6 py-4 text-left text-sm font-semibold text-[#0d121b] dark:text-gray-200">Module</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-[#0d121b] dark:text-gray-200">Type</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-[#0d121b] dark:text-gray-200">Session</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-[#0d121b] dark:text-gray-200">Note</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-[#0d121b] dark:text-gray-200">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#e7ebf3] dark:divide-gray-700">
                        @foreach($notes as $note)
                            <tr class="hover:bg-[#f9fbff] dark:hover:bg-[#1f2937] transition">
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="font-bold text-[#0d121b] dark:text-white">{{ $note->document?->module?->nom ?? '—' }}</span>
                                        <span class="text-xs text-[#4c669a] dark:text-gray-400">{{ $note->document?->module?->code ?? '—' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-[#0d121b] dark:text-white">
                                    <span class="inline-flex items-center rounded-md bg-blue-100 dark:bg-blue-900 px-2 py-1 text-xs font-semibold text-blue-700 dark:text-blue-200">
                                        {{ $note->type }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-[#0d121b] dark:text-white">{{ $note->session }}</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center rounded-md bg-green-100 dark:bg-green-900 px-3 py-1.5 text-sm font-bold text-green-700 dark:text-green-200">
                                        {{ $note->valeur ?? '—' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-[#4c669a] dark:text-gray-400">
                                    {{ $note->created_at?->format('d/m/Y H:i') ?? '—' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="flex flex-col items-center justify-center py-12">
                <span class="material-symbols-outlined text-6xl text-[#4c669a] dark:text-gray-500 mb-4">assessment</span>
                <p class="text-lg font-semibold text-[#4c669a] dark:text-gray-400">Aucune note attribuée pour le moment</p>
                <p class="text-sm text-[#4c669a] dark:text-gray-500 mt-2">Vos notes apparaîtront ici dès qu'elles seront publiées.</p>
            </div>
        @endif
    </div>
</div>
@endsection
