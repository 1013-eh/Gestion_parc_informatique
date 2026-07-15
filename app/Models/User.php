<?php

namespace App\Models;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Centre;
use App\Notifications\CustomResetPasswordNotification;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'matricule';
    public $incrementing = false;
    protected $keyType = 'int';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'matricule',
        'nom',
        'prenom',
        'email',
        'email_perso',
        'tel',
        'password',
        'etat',
        'first_login',
        'failed_attempts',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'first_login' => 'boolean',
        ];
    }

    /**
     * Utiliser le matricule comme clé de route.
     */
    public function getRouteKeyName(): string
    {
        return 'matricule';
    }
    
    public function centre(){
        return $this->hasOne(Centre::class, 'matricule', 'matricule');
    }
    public function isAdmin(): bool {
        return $this->centre?->type_consultation==='ADMIN';
    }
    public function canViewAllCentres(): bool
    {
        return $this->centre !== null && $this->centre->type_consultation !== 'PAR_CENTRE';
    }
    /**
     * Adresse e-mail utilisée pour les notifications.
     */
    public function routeNotificationForMail($notification): string
    {
        return $this->email_perso;
    }

    /**
     * Notification personnalisée de réinitialisation du mot de passe.
     */
    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new CustomResetPasswordNotification($token));
    }

    /**
     * Nom complet de l'utilisateur.
     */
    public function getNameAttribute(): string
    {
        return "{$this->nom} {$this->prenom}";
    }

}
