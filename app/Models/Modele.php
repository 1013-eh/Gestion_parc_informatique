<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modele extends Model
{
    protected $primaryKey = 'id_modele';

    protected $fillable = ['nom_modele', 'id_marque'];

    public function marque()
    {
        return $this->belongsTo(Marque::class, 'id_marque');
    }
}
