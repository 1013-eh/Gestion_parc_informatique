<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $primaryKey = 'id_region';

    protected $fillable = ['libelle_region', 'abreviation'];

    public function centres()
    {
        return $this->hasMany(Centre::class, 'id_region');
    }
}
