<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = [
        'filiere_id',
        'niveau_id',
        'semestre_id',
        'code',
        'nom',
        'statut',
        'responsable_user_id',
        'credits',
    ];

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }

    public function semestre()
    {
        return $this->belongsTo(Semestre::class);
    }

    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_user_id');
    }

    public function documents()
    {
        return $this->hasMany(DocumentNote::class);
    }
}