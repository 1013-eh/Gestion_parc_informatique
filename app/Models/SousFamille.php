<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SousFamille extends Model
{
    protected $fillable = ['nom_sous_famille', 'id_famille'];

    public function famille(){
        return $this->belongsTo(Famille::class);
    }

    public function materiels(){
        return $this->hasMany(Materiel::class, 'ID_FAMILLE', 'ID_FAMILLE');
    }
}
