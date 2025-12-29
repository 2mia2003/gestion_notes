 <!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'Gestion Modules et Filières')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&family=Noto+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700&display=swap" rel="stylesheet"/>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <!-- Theme Config -->
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#135bec",
                        "primary-hover": "#0f4bc4",
                        "background-light": "#f8f9fc",
                        "background-dark": "#101622",
                        "card-light": "#ffffff",
                        "card-dark": "#1e293b",
                        "border-light": "#e7ebf3",
                        "border-dark": "#334155",
                        "text-main-light": "#0d121b",
                        "text-main-dark": "#f1f5f9",
                        "text-sec-light": "#4c669a",
                        "text-sec-dark": "#94a3b8",
                    },
                    fontFamily: {
                        "display": ["Lexend", "Noto Sans", "sans-serif"],
                        "body": ["Noto Sans", "sans-serif"],
                    },
                    borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "2xl": "1rem", "full": "9999px"},
                },
            },
        }
    </script>
</head>

<body class="bg-background-light dark:bg-background-dark font-display text-text-main-light dark:text-text-main-dark antialiased selection:bg-primary selection:text-white transition-colors duration-200">
@php
    // onglet actif (tabs du bas)
    $tab = $tab ?? 'modules';
@endphp

<div class="flex min-h-screen w-full flex-col">

    <!-- Navbar -->
    <header class="sticky top-0 z-50 flex items-center justify-between border-b border-border-light dark:border-border-dark bg-card-light/80 dark:bg-card-dark/80 px-6 py-3 backdrop-blur-md">

        <div class="flex items-center gap-4">
            <div class="flex size-10 items-center justify-center rounded-lg bg-primary/10 text-primary">
                <span class="material-symbols-outlined text-2xl">school</span>
            </div>
            <div>
                <h2 class="text-lg font-bold leading-tight tracking-tight">Gestion Académique</h2>
                <p class="text-xs font-medium text-text-sec-light dark:text-text-sec-dark">Portail Administrateur</p>
            </div>
        </div>

        <!-- Menu pills (centre) -->
        <nav class="hidden md:flex flex-1 justify-center">
            <div class="flex items-center gap-1 rounded-full bg-background-light dark:bg-background-dark p-1 border border-border-light dark:border-border-dark">
                <a class="px-4 py-2 text-sm font-medium text-text-sec-light dark:text-text-sec-dark hover:text-primary transition-colors"
                   href="{{ route('accueil') }}">
                    Tableau de bord
                </a>

                <a class="px-4 py-2 text-sm font-bold text-primary bg-white dark:bg-slate-800 rounded-full shadow-sm"
                   href="{{ route('filiere.index') }}">
                    Filières &amp; Modules
                </a>

                <a class="px-4 py-2 text-sm font-medium text-text-sec-light dark:text-text-sec-dark hover:text-primary transition-colors"
                   href="{{ Route::has('etudiant.index') ? route('etudiant.index') : '#' }}">
                    Étudiants
                </a>

                @role('admin')
                    <a class="px-4 py-2 text-sm font-medium text-text-sec-light dark:text-text-sec-dark hover:text-primary transition-colors"
                       href="{{ route('parametres') }}">
                        Paramètres
                    </a>
                @endrole
            </div>
        </nav>

        <div class="flex items-center gap-4">
            <button class="flex size-9 items-center justify-center rounded-full text-text-sec-light hover:bg-background-light dark:hover:bg-slate-800 transition-colors">
                <span class="material-symbols-outlined">notifications</span>
            </button>

            <div class="flex items-center gap-3 pl-4 border-l border-border-light dark:border-border-dark">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-bold">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-text-sec-light dark:text-text-sec-dark">
                        {{ auth()->user()->getRoleNames()->first() ?? 'Utilisateur' }}
                    </p>
                </div>

                <div class="size-10 rounded-full bg-cover bg-center border-2 border-white dark:border-slate-700 shadow-sm"
                     style="background-image: url('https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=135bec&color=fff');">
                </div>

               
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 px-4 py-6 md:px-8 lg:px-12 xl:px-20 max-w-[1600px] mx-auto w-full">

        <!-- Breadcrumbs -->
        <div class="flex items-center gap-2 mb-6 text-sm">
            <a class="text-text-sec-light dark:text-text-sec-dark hover:text-primary flex items-center gap-1"
               href="{{ route('accueil') }}">
                <span class="material-symbols-outlined text-[18px]">home</span>
                Accueil
            </a>
            <span class="text-border-dark/30 dark:text-border-light/30">/</span>
            <span class="font-medium text-primary">Gestion Modules et Filières</span>
        </div>

        <!-- Page Heading & Actions -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
            <div class="max-w-2xl">
                <h1 class="text-3xl md:text-4xl font-black tracking-tight text-text-main-light dark:text-text-main-dark mb-2">
                    Configuration Académique
                </h1>
                <p class="text-text-sec-light dark:text-text-sec-dark text-lg leading-relaxed">
                    Créez et organisez les structures académiques, gérez les programmes et assignez les équipes pédagogiques.
                </p>
            </div>

            <div class="flex gap-3">
                @yield('page_actions')
            </div>
        </div>

        <!-- Tabs -->
        <div class="mb-6 border-b border-border-light dark:border-border-dark">
            <div class="flex gap-8">

                <a class="{{ $tab==='modules'
                        ? 'relative flex items-center gap-2 pb-4 text-sm font-bold text-primary'
                        : 'group flex items-center gap-2 pb-4 text-sm font-medium text-text-sec-light dark:text-text-sec-dark hover:text-primary transition-colors' }}"
                    href="{{ route('module.index') }}">
                    <span class="material-symbols-outlined {{ $tab==='modules' ? '' : 'group-hover:text-primary' }}">view_module</span>
                    Modules
                    @if($tab==='modules')
                        <span class="absolute bottom-0 left-0 h-0.5 w-full bg-primary"></span>
                    @endif
                </a>

                <a class="{{ $tab==='filieres'
                        ? 'relative flex items-center gap-2 pb-4 text-sm font-bold text-primary'
                        : 'group flex items-center gap-2 pb-4 text-sm font-medium text-text-sec-light dark:text-text-sec-dark hover:text-primary transition-colors' }}"
                   href="{{ route('filiere.index') }}">
                    <span class="material-symbols-outlined {{ $tab==='filieres' ? '' : 'group-hover:text-primary' }}">schema</span>
                    Filières
                    @if($tab==='filieres')
                        <span class="absolute bottom-0 left-0 h-0.5 w-full bg-primary"></span>
                    @endif
                </a>

                <a class="{{ $tab==='semestres'
                    ? 'relative flex items-center gap-2 pb-4 text-sm font-bold text-primary'
                    : 'group flex items-center gap-2 pb-4 text-sm font-medium text-text-sec-light dark:text-text-sec-dark hover:text-primary transition-colors' }}"
                   href="{{ route('semestre.index') }}">
                    <span class="material-symbols-outlined {{ $tab==='semestres' ? '' : 'group-hover:text-primary' }}">calendar_month</span>
                    Semestres
                    @if($tab==='semestres')
                        <span class="absolute bottom-0 left-0 h-0.5 w-full bg-primary"></span>
                    @endif
                </a>

                <a class="{{ $tab==='responsables'
                        ? 'relative flex items-center gap-2 pb-4 text-sm font-bold text-primary'
                        : 'group flex items-center gap-2 pb-4 text-sm font-medium text-text-sec-light dark:text-text-sec-dark hover:text-primary transition-colors' }}"
                    href="{{ Route::has('responsable.index') ? route('responsable.index') : '#' }}">
                    <span class="material-symbols-outlined {{ $tab==='responsables' ? '' : 'group-hover:text-primary' }}">groups</span>
                    Responsables
                    @if($tab==='responsables')
                        <span class="absolute bottom-0 left-0 h-0.5 w-full bg-primary"></span>
                    @endif
                </a>

            </div>
        </div>

        <!-- SEUL TRUC QUI CHANGE -->
        @yield('tab_content')

    </main>
</div>
</body>
</html>
