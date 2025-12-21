<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>GradeScanner Pro - Gestion de Profil</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&family=Noto+Sans:wght@400;500;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

    {{-- VITE --}}
    @vite(['resources/css/app.css','resources/js/app.js'])

    <style>
        body { font-family: 'Lexend', sans-serif; }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            font-size: 24px;
        }
        .material-symbols-outlined.fill {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-[#0d121b] dark:text-white transition-colors duration-200">
<div class="relative flex h-screen w-full flex-col overflow-hidden">

    <!-- Top Navigation -->
    <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-[#e7ebf3] dark:border-gray-800 bg-white dark:bg-[#1a2230] px-6 py-3 shrink-0 z-20">
        <div class="flex items-center gap-4">
            <div class="size-8 text-primary">
                <svg class="w-full h-full" fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                    <path d="M39.5563 34.1455V13.8546C39.5563 15.708 36.8773 17.3437 32.7927 18.3189C30.2914 18.916 27.263 19.2655 24 19.2655C20.737 19.2655 17.7086 18.916 15.2073 18.3189C11.1227 17.3437 8.44365 15.708 8.44365 13.8546V34.1455C8.44365 35.9988 11.1227 37.6346 15.2073 38.6098C17.7086 39.2069 20.737 39.5564 24 39.5564C27.263 39.5564 30.2914 39.2069 32.7927 38.6098C36.8773 37.6346 39.5563 35.9988 39.5563 34.1455Z" fill="currentColor"></path>
                    <path clip-rule="evenodd" d="M10.4485 13.8519C10.4749 13.9271 10.6203 14.246 11.379 14.7361C12.298 15.3298 13.7492 15.9145 15.6717 16.3735C18.0007 16.9296 20.8712 17.2655 24 17.2655C27.1288 17.2655 29.9993 16.9296 32.3283 16.3735C34.2508 15.9145 35.702 15.3298 36.621 14.7361C37.3796 14.246 37.5251 13.9271 37.5515 13.8519C37.5287 13.7876 37.4333 13.5973 37.0635 13.2931C36.5266 12.8516 35.6288 12.3647 34.343 11.9175C31.79 11.0295 28.1333 10.4437 24 10.4437C19.8667 10.4437 16.2099 11.0295 13.657 11.9175C12.3712 12.3647 11.4734 12.8516 10.9365 13.2931C10.5667 13.5973 10.4713 13.7876 10.4485 13.8519ZM37.5563 18.7877C36.3176 19.3925 34.8502 19.8839 33.2571 20.2642C30.5836 20.9025 27.3973 21.2655 24 21.2655C20.6027 21.2655 17.4164 20.9025 14.7429 20.2642C13.1498 19.8839 11.6824 19.3925 10.4436 18.7877V34.1275C10.4515 34.1545 10.5427 34.4867 11.379 35.027C12.298 35.6207 13.7492 36.2054 15.6717 36.6644C18.0007 37.2205 20.8712 37.5564 24 37.5564C27.1288 37.5564 29.9993 37.2205 32.3283 36.6644C34.2508 36.2054 35.702 35.6207 36.621 35.027C37.4573 34.4867 37.5485 34.1546 37.5563 34.1275V18.7877ZM41.5563 13.8546V34.1455C41.5563 36.1078 40.158 37.5042 38.7915 38.3869C37.3498 39.3182 35.4192 40.0389 33.2571 40.5551C30.5836 41.1934 27.3973 41.5564 24 41.5564C20.6027 41.5564 17.4164 41.1934 14.7429 40.5551C12.5808 40.0389 10.6502 39.3182 9.20848 38.3869C7.84205 37.5042 6.44365 36.1078 6.44365 34.1455L6.44365 13.8546C6.44365 12.2684 7.37223 11.0454 8.39581 10.2036C9.43325 9.3505 10.8137 8.67141 12.343 8.13948C15.4203 7.06909 19.5418 6.44366 24 6.44366C28.4582 6.44366 32.5797 7.06909 35.657 8.13948C37.1863 8.67141 38.5667 9.3505 39.6042 10.2036C40.6278 11.0454 41.5563 12.2684 41.5563 13.8546Z" fill="currentColor" fill-rule="evenodd"></path>
                </svg>
            </div>
            <h2 class="text-[#0d121b] dark:text-white text-lg font-bold leading-tight tracking-[-0.015em]">GradeScanner Pro</h2>
        </div>

        <div class="flex flex-1 justify-end gap-8 items-center">
            <div class="hidden lg:flex items-center gap-9">
                <a class="text-[#0d121b] dark:text-gray-200 text-sm font-medium leading-normal hover:text-primary transition-colors" href="#">Tableau de bord</a>
                <a class="text-[#0d121b] dark:text-gray-200 text-sm font-medium leading-normal hover:text-primary transition-colors" href="#">Scans</a>
                <a class="text-[#0d121b] dark:text-gray-200 text-sm font-medium leading-normal hover:text-primary transition-colors" href="#">Archives</a>
                <a class="text-[#0d121b] dark:text-gray-200 text-sm font-medium leading-normal hover:text-primary transition-colors" href="#">Utilisateurs</a>
            </div>

            <div class="flex items-center gap-4">
                <!-- Déconnexion Laravel -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="hidden sm:flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary text-white hover:bg-blue-700 transition-colors text-sm font-bold leading-normal tracking-[0.015em]">
                        <span class="truncate">Déconnexion</span>
                    </button>
                </form>

                <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10 border border-[#e7ebf3] dark:border-gray-700"
                     style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCfQhVgWeTXC5SLO1gKUcbNEtuNTClWn97ljsj58VNfIQpkCM2lNPxyMPenWLvr18Y38nkxodSVzMhijgDHiXhYhtlFrvtpktj-jyPrhKscl-34KiYfWBFCClw9nZNKA2EKMrolHj1RfSGd5cl19PeG37nxf-MmfDzCqzhEeDAK7mfpo06TyurY3UPiWKOOD-KHCKjkJStJa8M5N8A1_MXosYHlhJa-vPmQByNczYwFrT5b9pE_7pyXt1SerLkCAO79xB_Ly8pBiEY");'>
                </div>
            </div>
        </div>
    </header>

    <div class="flex flex-1 overflow-hidden">

        <!-- Sidebar -->
        <aside class="hidden lg:flex flex-col w-72 bg-white dark:bg-[#1a2230] border-r border-[#e7ebf3] dark:border-gray-800 shrink-0 h-full overflow-y-auto">
            <div class="flex flex-col p-6 h-full justify-between">
                <div class="flex flex-col gap-6">
                    <div class="flex flex-col gap-1">
                        <h1 class="text-[#0d121b] dark:text-white text-lg font-bold leading-normal">Paramètres</h1>
                        <p class="text-[#4c669a] dark:text-gray-400 text-sm font-normal leading-normal">Gestion du compte</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-primary/10 border-l-4 border-primary" href="#">
                            <span class="material-symbols-outlined text-primary fill">person</span>
                            <p class="text-primary text-sm font-bold leading-normal">Informations Personnelles</p>
                        </a>
                        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors text-[#4c669a] dark:text-gray-400 hover:text-[#0d121b] dark:hover:text-gray-200" href="#">
                            <span class="material-symbols-outlined">shield_person</span>
                            <p class="text-sm font-medium leading-normal">Rôles &amp; Permissions</p>
                        </a>
                        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors text-[#4c669a] dark:text-gray-400 hover:text-[#0d121b] dark:hover:text-gray-200" href="#">
                            <span class="material-symbols-outlined">lock</span>
                            <p class="text-sm font-medium leading-normal">Sécurité</p>
                        </a>
                        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors text-[#4c669a] dark:text-gray-400 hover:text-[#0d121b] dark:hover:text-gray-200" href="#">
                            <span class="material-symbols-outlined">notifications</span>
                            <p class="text-sm font-medium leading-normal">Notifications</p>
                        </a>
                    </div>
                </div>
                <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-800 border border-[#e7ebf3] dark:border-gray-700">
                    <p class="text-xs text-[#4c669a] dark:text-gray-400 font-medium mb-2">Besoin d'aide ?</p>
                    <a class="text-sm text-primary font-medium hover:underline" href="#">Contactez le support</a>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto bg-background-light dark:bg-background-dark p-4 lg:p-10 scroll-smooth">
            <div class="max-w-[960px] mx-auto flex flex-col gap-8 pb-20">

                <!-- Breadcrumbs -->
                <nav class="flex flex-wrap gap-2 items-center">
                    <a class="text-[#4c669a] dark:text-gray-400 text-sm font-medium leading-normal hover:text-primary transition-colors" href="#">Accueil</a>
                    <span class="text-[#4c669a] dark:text-gray-400 text-sm font-medium leading-normal">/</span>
                    <a class="text-[#4c669a] dark:text-gray-400 text-sm font-medium leading-normal hover:text-primary transition-colors" href="#">Paramètres</a>
                    <span class="text-[#4c669a] dark:text-gray-400 text-sm font-medium leading-normal">/</span>
                    <span class="text-[#0d121b] dark:text-white text-sm font-medium leading-normal">Gestion du Profil</span>
                </nav>

                <!-- Page Header -->
                <div class="flex flex-wrap justify-between gap-3">
                    <div class="flex min-w-72 flex-col gap-2">
                        <h1 class="text-[#0d121b] dark:text-white text-3xl font-bold leading-tight tracking-[-0.02em]">Profil et Compte</h1>
                        <p class="text-[#4c669a] dark:text-gray-400 text-base font-normal leading-normal">Gérez vos informations personnelles, votre rôle et la sécurité de votre compte.</p>
                    </div>
                    <button class="flex items-center justify-center gap-2 rounded-lg bg-primary h-10 px-6 text-white text-sm font-bold shadow-sm hover:bg-blue-700 transition-colors">
                        <span>Sauvegarder</span>
                    </button>
                </div>

                <!-- Profile Avatar Card -->
                <section class="bg-white dark:bg-[#1a2230] rounded-xl border border-[#e7ebf3] dark:border-gray-800 p-6 shadow-sm">
                    <div class="flex w-full flex-col gap-6 md:flex-row md:justify-between md:items-center">
                        <div class="flex gap-6 items-center">
                            <div class="bg-center bg-no-repeat bg-cover rounded-full h-24 w-24 ring-4 ring-gray-50 dark:ring-gray-800"
                                 style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuD0ShR5wpNVX-yjctZDZrq-pAvTZ6ctxnxoY7HL-HWbRCRarciMIp6mV1MmaYE1JgchpK0GMGWJQQ4hGGPabBxu8zOhTd8LdCOI02R_rjwV2GH8UkHoRdEVm72elFy_YzztSdaX14d_Rre2PW2Wj6u8lTkEJrj_hUkBPfI8NNqezrxfXwx4bN5RHnAnJK4NQ_IxlpzpyzYQdnapI6V7F27VUiTBm1QPuk0NCmRKGuSLdgDml_X6E63KTCpulI8UYgsUgv5OBRZwmZ4");'></div>
                            <div class="flex flex-col justify-center gap-1">
                               <h3 class="text-[#0d121b] dark:text-white text-xl font-bold leading-tight"> {{ auth()->user()->name }}</h3>
                               <p class="text-[#4c669a] dark:text-gray-400 text-sm font-normal">{{ auth()->user()->email }}</p>

                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 mt-2 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300 w-fit">
                                    <span class="material-symbols-outlined text-[14px]">verified_user</span>
                                    Administrateur
                                </span>
                            </div>
                        </div>
                        <button class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-[#f0f2f5] dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors text-[#0d121b] dark:text-white text-sm font-bold w-full md:w-auto">
                            <span class="truncate">Changer l'avatar</span>
                        </button>
                    </div>
                </section>

                <!-- Personal Information Form -->
                <section class="bg-white dark:bg-[#1a2230] rounded-xl border border-[#e7ebf3] dark:border-gray-800 p-6 shadow-sm">
                    <div class="flex items-center gap-3 mb-6 border-b border-[#e7ebf3] dark:border-gray-800 pb-4">
                        <span class="material-symbols-outlined text-primary">person</span>
                        <h2 class="text-lg font-bold text-[#0d121b] dark:text-white">Informations Personnelles</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex flex-col gap-2">
                            <label class="text-[#0d121b] dark:text-gray-200 text-sm font-medium" for="firstName">Prénom</label>
                            <input class="bg-[#f8f9fc] dark:bg-gray-800 border border-[#e7ebf3] dark:border-gray-700 text-[#0d121b] dark:text-white text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" id="firstName" placeholder="Votre prénom" type="text" value="Jean"/>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-[#0d121b] dark:text-gray-200 text-sm font-medium" for="lastName">Nom</label>
                            <input class="bg-[#f8f9fc] dark:bg-gray-800 border border-[#e7ebf3] dark:border-gray-700 text-[#0d121b] dark:text-white text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" id="lastName" placeholder="Votre nom" type="text" value="Dupont"/>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-[#0d121b] dark:text-gray-200 text-sm font-medium" for="email">Adresse Email</label>
                            <input class="bg-[#f8f9fc] dark:bg-gray-800 border border-[#e7ebf3] dark:border-gray-700 text-[#0d121b] dark:text-white text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" id="email" placeholder="exemple@domaine.com" type="email" value="jean.dupont@university.edu"/>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-[#0d121b] dark:text-gray-200 text-sm font-medium" for="phone">Téléphone</label>
                            <input class="bg-[#f8f9fc] dark:bg-gray-800 border border-[#e7ebf3] dark:border-gray-700 text-[#0d121b] dark:text-white text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" id="phone" placeholder="+33 6 ..." type="tel" value="+33 6 12 34 56 78"/>
                        </div>
                        <div class="flex flex-col gap-2 md:col-span-2">
                            <label class="text-[#0d121b] dark:text-gray-200 text-sm font-medium" for="department">Département Académique</label>
                            <select class="bg-[#f8f9fc] dark:bg-gray-800 border border-[#e7ebf3] dark:border-gray-700 text-[#0d121b] dark:text-white text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" id="department">
                                <option value="cs">Informatique &amp; Sciences du Numérique</option>
                                <option value="math">Mathématiques</option>
                                <option value="phys">Physique</option>
                                <option value="lit">Littérature</option>
                            </select>
                        </div>
                    </div>
                </section>

                <!-- Roles & Permissions -->
                <section class="bg-white dark:bg-[#1a2230] rounded-xl border border-[#e7ebf3] dark:border-gray-800 p-6 shadow-sm">
                    <div class="flex items-center gap-3 mb-6 border-b border-[#e7ebf3] dark:border-gray-800 pb-4">
                        <span class="material-symbols-outlined text-primary">shield_person</span>
                        <h2 class="text-lg font-bold text-[#0d121b] dark:text-white">Rôles et Autorisations</h2>
                    </div>
                    <div class="flex flex-col gap-6">
                        <div class="flex items-start gap-4 p-4 rounded-lg bg-blue-50 dark:bg-blue-900/20 border border-blue-100 dark:border-blue-800">
                            <span class="material-symbols-outlined text-primary mt-0.5">info</span>
                            <div>
                                <p class="text-sm font-medium text-[#0d121b] dark:text-white">Votre rôle actuel est : <span class="font-bold text-primary">Administrateur</span></p>
                                <p class="text-sm text-[#4c669a] dark:text-gray-400 mt-1">Les administrateurs ont un accès complet pour gérer les utilisateurs, les archives et les paramètres système.</p>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-[#0d121b] dark:text-white mb-3 uppercase tracking-wider text-xs">Autorisations actives</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div class="flex items-center gap-2 text-sm text-[#4c669a] dark:text-gray-300">
                                    <span class="material-symbols-outlined text-green-500 text-[20px]">check_circle</span>
                                    Scanner et importer des notes
                                </div>
                                <div class="flex items-center gap-2 text-sm text-[#4c669a] dark:text-gray-300">
                                    <span class="material-symbols-outlined text-green-500 text-[20px]">check_circle</span>
                                    Modifier les archives
                                </div>
                                <div class="flex items-center gap-2 text-sm text-[#4c669a] dark:text-gray-300">
                                    <span class="material-symbols-outlined text-green-500 text-[20px]">check_circle</span>
                                    Gérer les comptes utilisateurs
                                </div>
                                <div class="flex items-center gap-2 text-sm text-[#4c669a] dark:text-gray-300">
                                    <span class="material-symbols-outlined text-green-500 text-[20px]">check_circle</span>
                                    Accès aux logs de sécurité
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Security Section -->
                <section class="bg-white dark:bg-[#1a2230] rounded-xl border border-[#e7ebf3] dark:border-gray-800 p-6 shadow-sm">
                    <div class="flex items-center gap-3 mb-6 border-b border-[#e7ebf3] dark:border-gray-800 pb-4">
                        <span class="material-symbols-outlined text-primary">lock_reset</span>
                        <h2 class="text-lg font-bold text-[#0d121b] dark:text-white">Sécurité du Compte</h2>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                        <!-- Change Password -->
                        <div class="flex flex-col gap-4">
                            <h3 class="text-base font-bold text-[#0d121b] dark:text-white">Changer le mot de passe</h3>
                            <div class="flex flex-col gap-3">
                                <div class="flex flex-col gap-1">
                                    <label class="text-[#4c669a] dark:text-gray-400 text-xs font-medium uppercase" for="currentPwd">Mot de passe actuel</label>
                                    <div class="relative">
                                        <input class="bg-[#f8f9fc] dark:bg-gray-800 border border-[#e7ebf3] dark:border-gray-700 text-[#0d121b] dark:text-white text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 pr-10" id="currentPwd" type="password"/>
                                        <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                                            <span class="material-symbols-outlined text-[20px]">visibility</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label class="text-[#4c669a] dark:text-gray-400 text-xs font-medium uppercase" for="newPwd">Nouveau mot de passe</label>
                                    <input class="bg-[#f8f9fc] dark:bg-gray-800 border border-[#e7ebf3] dark:border-gray-700 text-[#0d121b] dark:text-white text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" id="newPwd" type="password"/>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label class="text-[#4c669a] dark:text-gray-400 text-xs font-medium uppercase" for="confirmPwd">Confirmer le mot de passe</label>
                                    <input class="bg-[#f8f9fc] dark:bg-gray-800 border border-[#e7ebf3] dark:border-gray-700 text-[#0d121b] dark:text-white text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" id="confirmPwd" type="password"/>
                                </div>
                                <button type="button" class="mt-2 w-fit px-4 py-2 bg-white dark:bg-gray-700 border border-[#e7ebf3] dark:border-gray-600 rounded-lg text-sm font-medium text-[#0d121b] dark:text-white hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                    Mettre à jour
                                </button>
                            </div>
                        </div>

                        <!-- 2FA & Sessions -->
                        <div class="flex flex-col gap-6">
                            <div class="flex flex-col gap-4">
                                <h3 class="text-base font-bold text-[#0d121b] dark:text-white">Authentification à deux facteurs (2FA)</h3>
                                <div class="flex items-center justify-between p-4 rounded-lg border border-[#e7ebf3] dark:border-gray-700 bg-[#f8f9fc] dark:bg-gray-800/50">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-medium text-[#0d121b] dark:text-white">Activer 2FA</span>
                                        <span class="text-xs text-[#4c669a] dark:text-gray-400">Sécurisez votre compte avec un code SMS.</span>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input checked class="sr-only peer" type="checkbox" value=""/>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary"></div>
                                    </label>
                                </div>
                            </div>

                            <div class="flex flex-col gap-4">
                                <h3 class="text-base font-bold text-[#0d121b] dark:text-white">Sessions actives</h3>
                                <p class="text-sm text-[#4c669a] dark:text-gray-400">
                                    Dernière connexion : <span class="font-medium text-[#0d121b] dark:text-gray-200">Aujourd'hui à 09:42</span> (Paris, FR)
                                </p>
                                <button type="button" class="flex items-center justify-center gap-2 w-full px-4 py-2.5 rounded-lg border border-red-200 dark:border-red-900 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 text-sm font-bold hover:bg-red-100 dark:hover:bg-red-900/30 transition-colors">
                                    <span class="material-symbols-outlined text-[18px]">logout</span>
                                    Déconnecter les autres sessions
                                </button>
                            </div>
                        </div>

                    </div>
                </section>

            </div>
        </main>

    </div>
</div>
</body>
</html>
