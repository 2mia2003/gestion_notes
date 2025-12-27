@extends('layouts.guest')

@section('content')
<form method="POST" action="{{ route('login') }}">
    @csrf

    <h1 class="text-2xl font-bold mb-6 text-center">Connexion</h1>

    {{-- Email --}}
    <div class="mb-4">
        <label class="block text-sm mb-1">Email</label>
        <input type="email" name="email" required autofocus
               class="w-full border rounded px-3 py-2"
               value="{{ old('email') }}">
        @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    {{-- Password --}}
    <div class="mb-4">
        <label class="block text-sm mb-1">Mot de passe</label>
        <input type="password" name="password" required
               class="w-full border rounded px-3 py-2">
        @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    {{-- Remember --}}
    <div class="mb-4 flex items-center">
        <input type="checkbox" name="remember" class="mr-2">
        <span class="text-sm">Se souvenir de moi</span>
    </div>

    <button class="w-full bg-blue-600 text-white py-2 rounded">
        Se connecter
    </button>

    {{-- REGISTER LINKS --}}
    <p class="text-center text-sm mt-4">
        Pas de compte ?
        <a href="{{ route('student.register') }}" class="text-blue-600 underline">
            Inscrivez-vous (Étudiant)
        </a>
       
    </p>
</form>
@endsection
