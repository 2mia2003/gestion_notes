<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnneeAcademique extends Model
{
    protected $table = 'annees_academiques';
    protected $fillable = ['libelle', 'active'];

    public function semestres()
    {
        return $this->hasMany(Semestre::class);
    }
}
