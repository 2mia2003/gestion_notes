@extends('layouts.app')

@section('title', 'Accueil')
@section('breadcrumb', 'Accueil')

@section('content')
    <div class="bg-white dark:bg-[#1a2230] rounded-xl border border-[#e7ebf3] dark:border-gray-800 p-6 shadow-sm">
        <h1 class="text-3xl font-bold">Accueil</h1>
        <p class="text-[#4c669a] dark:text-gray-400 mt-2">
            Bienvenue <span class="font-semibold text-[#0d121b] dark:text-white">{{ auth()->user()->name }}</span>
        </p>
        <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
           
            <a href="{{ route('filiere.index') }}" class="group rounded-xl border border-[#e7ebf3] dark:border-gray-700 bg-white dark:bg-[#121a27] p-5 hover:shadow-md transition-shadow">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-[#135bec] group-hover:scale-105 transition-transform">schema</span>
                    <div>
                        <h3 class="text-base font-bold">Filières & Modules</h3>
                        <p class="text-sm text-[#4c669a] dark:text-gray-400">Gérer les filières et leurs modules</p>
                    </div>
                </div>
            </a>

            
            <div class="rounded-xl border border-dashed border-[#e7ebf3] dark:border-gray-700 p-5 text-sm text-[#4c669a] dark:text-gray-400">
               XXXXXXXXXXXXXXXXXXXXXXX
            </div>

             <div class="rounded-xl border border-dashed border-[#e7ebf3] dark:border-gray-700 p-5 text-sm text-[#4c669a] dark:text-gray-400">
               XXXXXXXXXXXXXXXXXXXXXXX
            </div>

             <div class="rounded-xl border border-dashed border-[#e7ebf3] dark:border-gray-700 p-5 text-sm text-[#4c669a] dark:text-gray-400">
               XXXXXXXXXXXXXXXXXXXXXXX
            </div>
        </div>
    </div>
    <a href="{{ route('filiere.index') }}">module&filiere
        
    </a>



@endsection
