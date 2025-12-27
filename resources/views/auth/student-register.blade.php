@extends('layouts.guest')

@section('content')
<form method="POST" action="{{ auth()->check() && auth()->user()->hasRole('admin') ? route('admin.student.register') : route('student.register') }}">
    @csrf
    <h1 class="text-2xl font-bold mb-6 text-center">Inscription</h1>

    <div class="mb-4">
        <label class="block text-sm mb-1">Nom complet</label>
        <input type="text" name="name" class="w-full border rounded px-3 py-2" value="{{ old('name') }}" required>
        @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div class="mb-4">
        <label class="block text-sm mb-1">Email</label>
        <input type="email" name="email" class="w-full border rounded px-3 py-2" value="{{ old('email') }}" required>
        @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div class="mb-4">
        <label class="block text-sm mb-1">Mot de passe</label>
        <input type="password" name="password" class="w-full border rounded px-3 py-2" required>
        @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div class="mb-4">
        <label class="block text-sm mb-1">Confirmer le mot de passe</label>
        <input type="password" name="password_confirmation" class="w-full border rounded px-3 py-2" required>
    </div>

    <button class="w-full bg-green-600 text-white py-2 rounded mt-2">Créer le compte</button>

    @if(!auth()->check())
    <p class="text-center text-sm mt-4">
        Déjà un compte ? <a class="text-blue-600 underline" href="{{ route('login') }}">Connectez-vous</a>
    </p>
    @endif
</form>
@endsection
