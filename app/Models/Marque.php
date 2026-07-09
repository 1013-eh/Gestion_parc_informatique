<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marque extends Model
{
    protected $primaryKey = 'id_marque';

    protected $fillable = ['nom_marque', 'id_sous_famille'];

    public function sousFamille()
    {
        return $this->belongsTo(SousFamille::class, 'id_sous_famille');
    }
}
