<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    protected $fillable = ['departement_id', 'code', 'nom'];

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    public function niveaux()
    {
        return $this->hasMany(Niveau::class);
    }

    public function modules()
    {
        return $this->hasMany(Module::class);
    }
}
