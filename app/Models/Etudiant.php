<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    protected $fillable = [
        'matricule','prenom','nom','date_naissance','sexe','filiere_id','niveau_id'
    ];

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
