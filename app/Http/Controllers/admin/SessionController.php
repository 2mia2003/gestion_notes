<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;

class SessionController extends Controller
{
    public function logoutUser(User $user): RedirectResponse
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', "Tu ne peux pas te déconnecter via cette action.");
        }

        DB::table('sessions')->where('user_id', $user->id)->delete();

        return back()->with('success', "Utilisateur déconnecté: {$user->name}.");
    }

    public function logoutAll(): RedirectResponse
    {
        DB::table('sessions')->whereNotNull('user_id')->delete();

        return back()->with('success', 'Tous les utilisateurs ont été déconnectés.');
    }
}
