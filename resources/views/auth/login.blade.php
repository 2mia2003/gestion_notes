@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-background-light dark:bg-background-dark">
    <div class="w-full max-w-md bg-white dark:bg-[#1a2230] rounded-xl shadow-lg p-8">

        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-[#0d121b] dark:text-white">Connexion</h1>
            <p class="text-sm text-[#4c669a] dark:text-gray-400 mt-1">Accédez à GradeScanner Pro</p>
        </div>

        {{-- Status (ex: reset password envoyé) --}}
        @if (session('status'))
            <div class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                {{ session('status') }}
            </div>
        @endif

        {{-- Erreurs validation --}}
        @if ($errors->any())
            <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-[#0d121b] dark:text-gray-200">Email</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    class="mt-1 w-full rounded-lg border border-[#e7ebf3] dark:border-gray-700
                           bg-[#f8f9fc] dark:bg-gray-800
                           text-[#0d121b] dark:text-white
                           focus:ring-primary focus:border-primary"
                />
            </div>

            <div>
                <label class="block text-sm font-medium text-[#0d121b] dark:text-gray-200">Mot de passe</label>
                <input
                    type="password"
                    name="password"
                    required
                    class="mt-1 w-full rounded-lg border border-[#e7ebf3] dark:border-gray-700
                           bg-[#f8f9fc] dark:bg-gray-800
                           text-[#0d121b] dark:text-white
                           focus:ring-primary focus:border-primary"
                />
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center text-sm text-[#4c669a] dark:text-gray-400">
                    <input type="checkbox" name="remember"
                           class="rounded border-gray-300 text-primary shadow-sm focus:ring-primary">
                    <span class="ml-2">Se souvenir de moi</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-primary hover:underline">
                        Mot de passe oublié ?
                    </a>
                @endif
            </div>

            <button
                type="submit"
                class="w-full h-10 bg-primary text-white rounded-lg font-semibold
                       hover:bg-blue-700 transition"
            >
                Se connecter
            </button>
        </form>

        @if (Route::has('register'))
            <div class="text-center mt-6">
                <p class="text-sm text-[#4c669a] dark:text-gray-400">
                    Vous n’avez pas de compte ?
                    <a href="{{ route('register') }}" class="font-semibold text-primary hover:underline">
                        Inscrivez-vous
                    </a>
                </p>
            </div>
        @endif

    </div>
</div>
@endsection
