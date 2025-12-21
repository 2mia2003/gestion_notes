<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'document_note_id','etudiant_id','module_id','valeur','type','session'
    ];

    public function document()
    {
        return $this->belongsTo(DocumentNote::class, 'document_note_id');
    }

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
