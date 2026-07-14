<?php

namespace App\Models;

use App\Models\SousFamille;
use Illuminate\Database\Eloquent\Model;

class Famille extends Model
{
    protected $primaryKey = 'id_famille';
    protected $fillable = ['nom_famille'];

    public function sousFamilles()
    {
        return $this->hasMany(SousFamille::class, 'id_famille', 'id_famille');
    }
}
