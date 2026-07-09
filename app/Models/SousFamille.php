<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SousFamille extends Model
{
    protected $primaryKey = 'id_sous_famille';

    protected $fillable = ['nom_sous_famille', 'id_famille'];

    public function famille()
    {
        return $this->belongsTo(Famille::class, 'id_famille');
    }

    public function materiels()
    {
        return $this->hasMany(Materiel::class, 'id_sous_famille');
    }
}
