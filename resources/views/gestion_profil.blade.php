@extends('layouts.app')

@section('title', 'Gestion du Profil')
@section('breadcrumb', 'Gestion du Profil')

@section('content')
    <!-- Header page -->
    <div class="flex flex-wrap justify-between gap-3">
        <div class="flex min-w-72 flex-col gap-2">
            <h1 class="text-3xl font-bold leading-tight tracking-[-0.02em]">Profil et Compte</h1>
            <p class="text-[#4c669a] dark:text-gray-400 text-base">
                Gérez vos informations personnelles, votre rôle et la sécurité de votre compte.
            </p>
        </div>

        <button class="flex items-center justify-center gap-2 rounded-lg bg-[#135bec] h-10 px-6 text-white text-sm font-bold shadow-sm hover:bg-blue-700 transition-colors">
            Sauvegarder
        </button>
    </div>

    <!-- Avatar card -->
    <section class="bg-white dark:bg-[#1a2230] rounded-xl border border-[#e7ebf3] dark:border-gray-800 p-6 shadow-sm">
        <div class="flex w-full flex-col gap-6 md:flex-row md:justify-between md:items-center">
            <div class="flex gap-6 items-center">
                <div class="bg-center bg-no-repeat bg-cover rounded-full h-24 w-24 ring-4 ring-gray-50 dark:ring-gray-800"
                     style='background-image: url("https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=E5E7EB&color=111827");'>
                </div>

                <div class="flex flex-col justify-center gap-1">
                    <h3 class="text-xl font-bold">{{ auth()->user()->name }}</h3>
                    <p class="text-[#4c669a] dark:text-gray-400 text-sm">{{ auth()->user()->email }}</p>

                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 mt-2 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300 w-fit">
                        <span class="material-symbols-outlined" style="font-size:14px;">verified_user</span>
                        {{ auth()->user()->getRoleNames()->first() ?? 'Utilisateur' }}
                    </span>
                </div>
            </div>

            <button class="flex min-w-[84px] items-center justify-center rounded-lg h-10 px-4 bg-[#f0f2f5] dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors text-sm font-bold">
                Changer l'avatar
            </button>
        </div>
    </section>

    <!-- Infos personnelles -->
    <section class="bg-white dark:bg-[#1a2230] rounded-xl border border-[#e7ebf3] dark:border-gray-800 p-6 shadow-sm">
        <div class="flex items-center gap-3 mb-6 border-b border-[#e7ebf3] dark:border-gray-800 pb-4">
            <span class="material-symbols-outlined text-[#135bec]">person</span>
            <h2 class="text-lg font-bold">Informations Personnelles</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="flex flex-col gap-2">
                <label class="text-sm font-medium" for="name">Nom complet</label>
                <input id="name" type="text"
                       class="bg-[#f8f9fc] dark:bg-gray-800 border border-[#e7ebf3] dark:border-gray-700 text-sm rounded-lg focus:ring-[#135bec] focus:border-[#135bec] block w-full p-2.5"
                       value="{{ auth()->user()->name }}">
            </div>

            <div class="flex flex-col gap-2">
                <label class="text-sm font-medium" for="email">Email</label>
                <input id="email" type="email"
                       class="bg-[#f8f9fc] dark:bg-gray-800 border border-[#e7ebf3] dark:border-gray-700 text-sm rounded-lg focus:ring-[#135bec] focus:border-[#135bec] block w-full p-2.5"
                       value="{{ auth()->user()->email }}">
            </div>
        </div>
    </section>
@endsection
