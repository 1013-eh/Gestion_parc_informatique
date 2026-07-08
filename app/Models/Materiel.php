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
        'num_serie', 'id_sous_famille', 'code_bureau', 'marque', 'modele',
        'cab', 'num_marche', 'date_affectation', 'num_ordre', 'machine', 'etat'
    ];

    public function sousFamille()
    {
        return $this->belongsTo(SousFamille::class, 'id_sous_famille');
    }

    public function centre()
    {
        return $this->belongsTo(Centre::class, 'code_bureau', 'code_bureau');
    }
}
