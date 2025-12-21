<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * Champs autorisés en mass assignment
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Champs cachés lors de la sérialisation
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casts automatiques
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /* =========================================================
       RELATIONS MÉTIER
       ========================================================= */

    /**
     * Documents de notes importés par l'utilisateur
     */
    public function uploadedDocuments()
    {
        return $this->hasMany(DocumentNote::class, 'user_id');
    }

    /**
     * Validations effectuées par l'utilisateur (workflow)
     */
    public function validations()
    {
        return $this->hasMany(WorkflowNote::class, 'user_id');
    }

    /**
     * Logs d'audit liés à l'utilisateur
     */
    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class, 'user_id');
    }

    /**
     * Modules dont l'utilisateur est responsable (enseignant)
     */
    public function responsableModules()
    {
        return $this->hasMany(Module::class, 'responsable_user_id');
    }
}
