<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkflowNote extends Model
{
    protected $fillable = ['document_note_id','user_id','action','commentaire'];

    public function document()
    {
        return $this->belongsTo(DocumentNote::class, 'document_note_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
