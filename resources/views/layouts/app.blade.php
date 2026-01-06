<!DOCTYPE html>
<html lang="fr" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GradeScanner Pro')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&family=Noto+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: "Lexend", "Noto Sans", sans-serif; }
        .material-symbols-outlined {
            font-variation-settings: "FILL" 0, "wght" 400, "GRAD" 0, "opsz" 24;
            font-size: 22px;
            line-height: 1;
        }
        .material-symbols-outlined.fill {
            font-variation-settings: "FILL" 1, "wght" 400, "GRAD" 0, "opsz" 24;
        }
    </style>
</head>

<body class="bg-[#f8f9fc] text-[#0d121b] dark:bg-[#101622] dark:text-white transition-colors duration-200">
<div class="relative flex h-screen w-full overflow-hidden">

    <!-- SIDEBAR (toujours visible) -->
    <aside class="flex flex-col w-72 bg-white dark:bg-[#1a2230] border-r border-[#e7ebf3] dark:border-gray-800 shrink-0 h-full overflow-y-auto">
        <div class="flex flex-col p-6 h-full justify-between">

            <div class="flex flex-col gap-6">
                <!-- Brand dans le sidebar (comme ta maquette) -->
                <div class="flex items-center gap-3">
                    <div class="size-8 text-[#135bec]">
                        <svg class="w-full h-full" fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                            <path d="M39.5563 34.1455V13.8546C39.5563 15.708 36.8773 17.3437 32.7927 18.3189C30.2914 18.916 27.263 19.2655 24 19.2655C20.737 19.2655 17.7086 18.916 15.2073 18.3189C11.1227 17.3437 8.44365 15.708 8.44365 13.8546V34.1455C8.44365 35.9988 11.1227 37.6346 15.2073 38.6098C17.7086 39.2069 20.737 39.5564 24 39.5564C27.263 39.5564 30.2914 39.2069 32.7927 38.6098C36.8773 37.6346 39.5563 35.9988 39.5563 34.1455Z" fill="currentColor"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.4485 13.8519C10.4749 13.9271 10.6203 14.246 11.379 14.7361C12.298 15.3298 13.7492 15.9145 15.6717 16.3735C18.0007 16.9296 20.8712 17.2655 24 17.2655C27.1288 17.2655 29.9993 16.9296 32.3283 16.3735C34.2508 15.9145 35.702 15.3298 36.621 14.7361C37.3796 14.246 37.5251 13.9271 37.5515 13.8519C37.5287 13.7876 37.4333 13.5973 37.0635 13.2931C36.5266 12.8516 35.6288 12.3647 34.343 11.9175C31.79 11.0295 28.1333 10.4437 24 10.4437C19.8667 10.4437 16.2099 11.0295 13.657 11.9175C12.3712 12.3647 11.4734 12.8516 10.9365 13.2931C10.5667 13.5973 10.4713 13.7876 10.4485 13.8519ZM41.5563 13.8546V34.1455C41.5563 36.1078 40.158 37.5042 38.7915 38.3869C37.3498 39.3182 35.4192 40.0389 33.2571 40.5551C30.5836 41.1934 27.3973 41.5564 24 41.5564C20.6027 41.5564 17.4164 41.1934 14.7429 40.5551C12.5808 40.0389 10.6502 39.3182 9.20848 38.3869C7.84205 37.5042 6.44365 36.1078 6.44365 34.1455L6.44365 13.8546C6.44365 12.2684 7.37223 11.0454 8.39581 10.2036C9.43325 9.3505 10.8137 8.67141 12.343 8.13948C15.4203 7.06909 19.5418 6.44366 24 6.44366C28.4582 6.44366 32.5797 7.06909 35.657 8.13948C37.1863 8.67141 38.5667 9.3505 39.6042 10.2036C40.6278 11.0454 41.5563 12.2684 41.5563 13.8546Z" fill="currentColor"></path>
                        </svg>
                    </div>
                    <h2 class="text-[#0d121b] dark:text-white text-lg font-bold leading-tight tracking-[-0.015em]">
                        GradeScanner Pro
                    </h2>
                </div>

                <div class="flex flex-col gap-1">
                    <h1 class="text-[#0d121b] dark:text-white text-lg font-bold leading-normal">Navigation</h1>
                    <p class="text-[#4c669a] dark:text-gray-400 text-sm font-normal leading-normal">Pages principales</p>
                </div>

                <!-- Liens principaux selon le rôle -->
                <nav class="flex flex-col gap-2">
                    {{-- Zone Étudiant --}}
                    @if(auth()->check() && auth()->user()->hasRole('etudiant'))
                        <a href="{{ route('student.dashboard') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-lg
                           {{ request()->routeIs('student.dashboard') ? 'bg-[#135bec]/10 border-l-4 border-[#135bec] text-[#135bec] font-bold' : 'hover:bg-gray-50 dark:hover:bg-gray-800 text-[#4c669a] dark:text-gray-400' }}">
                            <span class="material-symbols-outlined">assignment_ind</span>
                            Mes Notes
                        </a>

                        <a href="{{ route('student.edit-password') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-lg
                           {{ request()->routeIs('student.edit-password') ? 'bg-[#135bec]/10 border-l-4 border-[#135bec] text-[#135bec] font-bold' : 'hover:bg-gray-50 dark:hover:bg-gray-800 text-[#4c669a] dark:text-gray-400' }}">
                            <span class="material-symbols-outlined">lock</span>
                            Changer mot de passe
                        </a>
                    {{-- Zone Professeur --}}
                    @elseif(auth()->check() && auth()->user()->hasRole('enseignant'))
                        <a href="{{ route('professor.welcome') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-lg
                           {{ request()->routeIs('professor.welcome', 'professor.dashboard') ? 'bg-[#135bec]/10 border-l-4 border-[#135bec] text-[#135bec] font-bold' : 'hover:bg-gray-50 dark:hover:bg-gray-800 text-[#4c669a] dark:text-gray-400' }}">
                            <span class="material-symbols-outlined">home</span>
                            Accueil
                        </a>
                    {{-- Zone Admin --}}
                    @elseif(auth()->check() && auth()->user()->hasRole('admin'))
                        <a href="{{ route('accueil') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-lg
                           {{ request()->routeIs('accueil') ? 'bg-[#135bec]/10 border-l-4 border-[#135bec] text-[#135bec] font-bold' : 'hover:bg-gray-50 dark:hover:bg-gray-800 text-[#4c669a] dark:text-gray-400' }}">
                            <span class="material-symbols-outlined">home</span>
                            Accueil
                        </a>

                        <a href="{{ route('filiere.index') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-lg
                           {{ request()->routeIs('filiere.index') ? 'bg-[#135bec]/10 border-l-4 border-[#135bec] text-[#135bec] font-bold' : 'hover:bg-gray-50 dark:hover:bg-gray-800 text-[#4c669a] dark:text-gray-400' }}">
                            <span class="material-symbols-outlined">schema</span>
                            Filières & Modules
                        </a>

                        <a href="{{ route('parametres') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-lg
                           {{ request()->routeIs('parametres') ? 'bg-[#135bec]/10 border-l-4 border-[#135bec] text-[#135bec] font-bold' : 'hover:bg-gray-50 dark:hover:bg-gray-800 text-[#4c669a] dark:text-gray-400' }}">
                            <span class="material-symbols-outlined">settings</span>
                            Paramètres
                        </a>

                        <a href="{{ route('admin.dashboard') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-lg
                           {{ request()->routeIs('admin.dashboard') ? 'bg-[#135bec]/10 border-l-4 border-[#135bec] text-[#135bec] font-bold' : 'hover:bg-gray-50 dark:hover:bg-gray-800 text-[#4c669a] dark:text-gray-400' }}">
                            <span class="material-symbols-outlined">shield</span>
                            Admin
                        </a>
                    @endif

                    {{-- Lien profil (disponible pour tous) --}}
                    <a href="{{ route('gestion.profil') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg
                       {{ request()->routeIs('gestion.profil') ? 'bg-[#135bec]/10 border-l-4 border-[#135bec] text-[#135bec] font-bold' : 'hover:bg-gray-50 dark:hover:bg-gray-800 text-[#4c669a] dark:text-gray-400' }}">
                        <span class="material-symbols-outlined">person</span>
                        Gestion du profil
                    </a>
                </nav>
            </div>

            <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-800 border border-[#e7ebf3] dark:border-gray-700">
                <p class="text-xs text-[#4c669a] dark:text-gray-400 font-medium mb-2">Besoin d'aide ?</p>
                <a class="text-sm text-[#135bec] font-medium hover:underline" href="#">Contactez le support</a>
            </div>
        </div>
    </aside>

    <!-- ZONE DROITE : TOPBAR + CONTENU -->
    <div class="flex flex-1 flex-col overflow-hidden">

        <!-- TOPBAR (toujours visible) -->
        <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-[#e7ebf3] dark:border-gray-800 bg-white dark:bg-[#1a2230] px-6 py-3 shrink-0 z-20">
            <div class="flex items-center gap-3">
                <span class="text-sm text-[#4c669a] dark:text-gray-400">Gestion des notes</span>
            </div>

            <div class="flex items-center gap-6">
                <div class="flex items-center gap-6">
                    {{-- Zone Étudiant --}}
                    @if(auth()->check() && auth()->user()->hasRole('etudiant'))
                        <a class="text-[#0d121b] dark:text-gray-200 text-sm font-medium hover:text-[#135bec] transition-colors"
                           href="{{ route('student.dashboard') }}">Mes Notes</a>
                        <a class="text-[#0d121b] dark:text-gray-200 text-sm font-medium hover:text-[#135bec] transition-colors"
                           href="{{ route('student.edit-password') }}">Changer mot de passe</a>
                    {{-- Zone Professeur --}}
                    @elseif(auth()->check() && auth()->user()->hasRole('enseignant'))
                        <a class="text-[#0d121b] dark:text-gray-200 text-sm font-medium hover:text-[#135bec] transition-colors"
                           href="{{ route('professor.welcome') }}">Accueil</a>
                    {{-- Zone Admin --}}
                    @elseif(auth()->check() && auth()->user()->hasRole('admin'))
                        <a class="text-[#0d121b] dark:text-gray-200 text-sm font-medium hover:text-[#135bec] transition-colors"
                           href="{{ route('accueil') }}">Accueil</a>
                        <a class="text-[#0d121b] dark:text-gray-200 text-sm font-medium hover:text-[#135bec] transition-colors"
                            href="{{ route('filiere.index') }}">Filières & Modules</a>
                        <a class="text-[#0d121b] dark:text-gray-200 text-sm font-medium hover:text-[#135bec] transition-colors"
                           href="{{ route('parametres') }}">Paramètres</a>
                        <a class="text-[#0d121b] dark:text-gray-200 text-sm font-medium hover:text-[#135bec] transition-colors"
                           href="{{ route('admin.dashboard') }}">Admin</a>
                    @endif

                    <a class="text-[#0d121b] dark:text-gray-200 text-sm font-medium hover:text-[#135bec] transition-colors"
                       href="{{ route('gestion.profil') }}">Gestion profil</a>
                </div>

                <div class="flex items-center gap-3">
                    <span class="text-sm font-medium text-[#0d121b] dark:text-gray-200">
                        {{ auth()->user()->name ?? 'Utilisateur' }}
                    </span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="min-w-[110px] h-10 px-4 rounded-lg bg-[#135bec] text-white hover:bg-blue-700 transition-colors text-sm font-bold">
                            Déconnexion
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <!-- CONTENU (breadcrumbs + page) -->
        <main class="flex-1 overflow-y-auto bg-[#f8f9fc] dark:bg-[#101622] p-4 lg:p-10 scroll-smooth">
            <div class="max-w-[960px] mx-auto flex flex-col gap-6 pb-20">

                <!-- Breadcrumbs (toujours affiché) -->
                <nav class="flex flex-wrap gap-2 items-center">
                    @if(auth()->check() && auth()->user()->hasRole('admin'))
                        <a class="text-[#4c669a] dark:text-gray-400 text-sm font-medium hover:text-[#135bec] transition-colors"
                           href="{{ route('accueil') }}">Accueil</a>
                        <span class="text-[#4c669a] dark:text-gray-400 text-sm font-medium">/</span>
                    @elseif(auth()->check() && auth()->user()->hasRole('enseignant'))
                        <a class="text-[#4c669a] dark:text-gray-400 text-sm font-medium hover:text-[#135bec] transition-colors"
                           href="{{ route('professor.welcome') }}">Accueil</a>
                        <span class="text-[#4c669a] dark:text-gray-400 text-sm font-medium">/</span>
                    @elseif(auth()->check() && auth()->user()->hasRole('etudiant'))
                        <a class="text-[#4c669a] dark:text-gray-400 text-sm font-medium hover:text-[#135bec] transition-colors"
                           href="{{ route('student.dashboard') }}">Mes Notes</a>
                        <span class="text-[#4c669a] dark:text-gray-400 text-sm font-medium">/</span>
                    @endif
                    <span class="text-[#0d121b] dark:text-white text-sm font-medium">
                        @yield('breadcrumb', 'Page')
                    </span>
                </nav>

                @yield('content')
            </div>
        </main>
    </div>
</div>
</body>
</html>
