<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoriqueResponsable extends Model
{
    protected $fillable = [
        'code_bureau',
        'ancien_matricule',
        'nouveau_matricule',
        'date_changement',
    ];
}
