@extends('layouts.app')

@section('title', 'Accueil')
@section('breadcrumb', 'Accueil')

@section('content')
    <div class="bg-white dark:bg-[#1a2230] rounded-xl border border-[#e7ebf3] dark:border-gray-800 p-6 shadow-sm">
        <h1 class="text-3xl font-bold">Accueil</h1>
        <p class="text-[#4c669a] dark:text-gray-400 mt-2">
            Bienvenue <span class="font-semibold text-[#0d121b] dark:text-white">{{ auth()->user()->name }}</span>
        </p>
        
    </div>
@endsection
