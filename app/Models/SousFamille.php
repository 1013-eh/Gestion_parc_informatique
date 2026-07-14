<?php

namespace App\Models;
use App\Models\Famille;
use App\Models\Marque;
use Illuminate\Database\Eloquent\Model;

class SousFamille extends Model
{
    protected $primaryKey = 'id_sous_famille';
    protected $fillable = ['nom_sous_famille', 'id_famille'];

    public function famille()
    {
        return $this->belongsTo(Famille::class, 'id_famille');
    }

    public function marques(){
        return $this->hasMany(Marque::class, 'id_sous_famille', 'id_sous_famille');
    }

    public function marques()
    {
        return $this->hasMany(Marque::class, 'id_sous_famille');
    }
}
