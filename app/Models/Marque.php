<?php

namespace App\Models;
use App\Models\SousFamille;
use App\Models\Modele;
use Illuminate\Database\Eloquent\Model;

class Marque extends Model
{
    protected $primaryKey = 'id_marque';
    protected $fillable = ['nom_marque', 'id_sous_famille'];

    public function sousfamille(){
        return $this->belongsTo(SousFamille::class);
    }

    public function modeles(){
        return $this->hasMany(Modele::class, 'id_marque', 'id_marque');
    }
}
