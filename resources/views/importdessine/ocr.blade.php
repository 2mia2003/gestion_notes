<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>

    <title>@yield('title', 'GradeScanner')</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&family=Noto+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700&display=swap" rel="stylesheet"/>

    {{-- Tailwind CDN + config (identique à ta maquette) --}}
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
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
<div class="flex min-h-screen w-full flex-col">

    {{-- Navbar --}}
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

        {{-- Menu central (tu peux le connecter à tes routes plus tard) --}}
        <nav class="hidden md:flex flex-1 justify-center">
            <div class="flex items-center gap-1 rounded-full bg-background-light dark:bg-background-dark p-1 border border-border-light dark:border-border-dark">
                <a class="px-4 py-2 text-sm font-medium text-text-sec-light dark:text-text-sec-dark hover:text-primary transition-colors" href="{{ route('accueil') }}">Tableau de bord</a>
                <a class="px-4 py-2 text-sm font-bold text-primary bg-white dark:bg-slate-800 rounded-full shadow-sm" href="{{ route('imports.step1') }}">Importation</a>
                <a class="px-4 py-2 text-sm font-medium text-text-sec-light dark:text-text-sec-dark hover:text-primary transition-colors" href="#">Archives</a>
                <a class="px-4 py-2 text-sm font-medium text-text-sec-light dark:text-text-sec-dark hover:text-primary transition-colors" href="#">Paramètres</a>
            </div>
        </nav>

        <div class="flex items-center gap-4">
            <button class="flex size-9 items-center justify-center rounded-full text-text-sec-light hover:bg-background-light dark:hover:bg-slate-800 transition-colors">
                <span class="material-symbols-outlined">notifications</span>
            </button>

            <div class="flex items-center gap-3 pl-4 border-l border-border-light dark:border-border-dark">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-bold">{{ auth()->user()->name ?? 'Utilisateur' }}</p>
                    <p class="text-xs text-text-sec-light dark:text-text-sec-dark">
                        {{ auth()->user()?->getRoleNames()?->first() ?? '—' }}
                    </p>
                </div>

                <div class="size-10 rounded-full bg-cover bg-center border-2 border-white dark:border-slate-700 shadow-sm"
                     style="background-image: url('https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'U') }}&background=135bec&color=fff');">
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-sm font-semibold text-red-600 hover:text-red-700">Déconnexion</button>
                </form>
            </div>
        </div>
    </header>

    {{-- Main --}}
    <main class="flex-1 px-4 py-6 md:px-8 lg:px-12 xl:px-20 max-w-[1600px] mx-auto w-full">
        @yield('content')
    </main>

</div>
</body>
</html>
