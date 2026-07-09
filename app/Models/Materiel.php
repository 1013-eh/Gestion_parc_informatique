<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materiel extends Model
{
    protected $table = 'materiels';
    protected $primaryKey = 'num_serie';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'num_serie', 'code_bureau', 'id_modele', 'cab', 'num_marche',
        'date_affectation', 'num_ordre', 'machine', 'etat'
    ];

    public function centre()
    {
        return $this->belongsTo(Centre::class, 'code_bureau', 'code_bureau');
    }

    public function modele()
    {
        return $this->belongsTo(Modele::class, 'id_modele');
    }
}
