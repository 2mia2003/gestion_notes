<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentNote extends Model
{
    protected $table = 'documents_notes';

    protected $fillable = [
        'module_id','semestre_id','user_id','titre','fichier_path','original_name',
        'statut','submitted_at','approved_at'
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function semestre()
    {
        return $this->belongsTo(Semestre::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function workflows()
    {
        return $this->hasMany(WorkflowNote::class);
    }

    public function auditLogs()
    {
        return $this->morphMany(AuditLog::class, 'subject');
    }
}
