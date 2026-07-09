<?php

namespace App\Models;
use App\Models\Materiel;
use App\Models\Marque;
use Illuminate\Database\Eloquent\Model;

class Modele extends Model
{
     protected $primaryKey = 'id_modele';
    protected $fillable = ['nom_modele', 'id_marque'];

    public function marque(){
        return $this->belongsTo(Marque::class);
    }

    public function materiels(){
        return $this->hasMany(Materiel::class, 'id_modele', 'id_modele');
    }

}
