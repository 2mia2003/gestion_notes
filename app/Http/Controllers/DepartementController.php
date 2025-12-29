<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DepartementController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => ['required','string','max:20', Rule::unique('departements','code')],
            'nom'  => ['required','string','max:150', Rule::unique('departements','nom')],
        ]);

        Departement::create($data);

        return back()->with('status','Département créé');
    }
}
