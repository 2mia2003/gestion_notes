<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
{
    protected $fillable = ['filiere_id', 'code', 'nom'];

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    public function modules()
    {
        return $this->hasMany(Module::class);
    }
}
