@extends('layouts.app')

@section('title', 'Changer mon mot de passe')
@section('breadcrumb', 'Étudiant / Changer mon mot de passe')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white dark:bg-[#1a2230] rounded-xl border border-[#e7ebf3] dark:border-gray-800 p-8 shadow-sm">
        <h1 class="text-3xl font-bold text-[#0d121b] dark:text-white mb-2">Changer mon mot de passe</h1>
        <p class="text-[#4c669a] dark:text-gray-400 mb-8">Pour sécuriser votre compte, mettez à jour votre mot de passe régulièrement.</p>

        @if($errors->any())
            <div class="mb-6 p-4 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800">
                <p class="text-sm font-bold text-red-700 dark:text-red-200 mb-2">Erreur :</p>
                <ul class="text-sm text-red-600 dark:text-red-300 list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('student.update-password') }}" class="space-y-6">
            @csrf

            <!-- Mot de passe actuel -->
            <div class="space-y-2">
                <label class="block text-sm font-bold text-[#0d121b] dark:text-white">Mot de passe actuel *</label>
                <input type="password" name="current_password" 
                       class="w-full rounded-lg border border-[#e7ebf3] dark:border-gray-700 bg-white dark:bg-[#111827] px-4 py-3 text-[#0d121b] dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       required>
                @error('current_password')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nouveau mot de passe -->
            <div class="space-y-2">
                <label class="block text-sm font-bold text-[#0d121b] dark:text-white">Nouveau mot de passe *</label>
                <input type="password" name="password" 
                       class="w-full rounded-lg border border-[#e7ebf3] dark:border-gray-700 bg-white dark:bg-[#111827] px-4 py-3 text-[#0d121b] dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       required>
                <p class="text-xs text-[#4c669a] dark:text-gray-400 mt-1">Minimum 8 caractères</p>
                @error('password')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirmation mot de passe -->
            <div class="space-y-2">
                <label class="block text-sm font-bold text-[#0d121b] dark:text-white">Confirmer le mot de passe *</label>
                <input type="password" name="password_confirmation" 
                       class="w-full rounded-lg border border-[#e7ebf3] dark:border-gray-700 bg-white dark:bg-[#111827] px-4 py-3 text-[#0d121b] dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       required>
                @error('password_confirmation')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Boutons -->
            <div class="flex items-center gap-4 pt-6 border-t border-[#e7ebf3] dark:border-gray-700">
                <a href="{{ route('student.dashboard') }}" class="px-6 py-2.5 rounded-lg bg-gray-100 dark:bg-gray-700 text-[#0d121b] dark:text-white font-bold text-sm hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                    Annuler
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm transition">
                    Mettre à jour le mot de passe
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
