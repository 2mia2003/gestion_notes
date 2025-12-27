@extends('layouts.guest')

@section('content')
<form method="POST" action="{{ route('register') }}">
    @csrf

    <h1 class="text-2xl font-bold mb-6 text-center">Créer un compte (admin)</h1>

    {{-- Name --}}
    <div class="mb-4">
        <label class="block text-sm mb-1">Nom</label>
        <input name="name" required
               class="w-full border rounded px-3 py-2"
               value="{{ old('name') }}">
        @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    {{-- Email --}}
    <div class="mb-4">
        <label class="block text-sm mb-1">Email</label>
        <input type="email" name="email" required
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

    {{-- Confirm --}}
    <div class="mb-6">
        <label class="block text-sm mb-1">Confirmer le mot de passe</label>
        <input type="password" name="password_confirmation" required
               class="w-full border rounded px-3 py-2">
    </div>

    {{-- Role --}}
    <div class="mb-6">
        <label class="block text-sm mb-1">Rôle</label>
        <select name="role" required class="w-full border rounded px-3 py-2">
            @foreach(($roles ?? []) as $role)
                <option value="{{ $role }}" @selected(old('role') === $role)>{{ $role }}</option>
            @endforeach
        </select>
        @error('role') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        <p class="text-xs text-gray-500 mt-1">Si c’est le tout premier utilisateur, le rôle sera forcé à "admin".</p>
    </div>

    <button class="w-full bg-green-600 text-white py-2 rounded">
        S’inscrire
    </button>

    <p class="text-center text-sm mt-4">
        <a href="{{ route('admin.dashboard') }}" class="text-blue-600 underline">
            Retour au dashboard admin
        </a>
    </p>
</form>
@endsection
