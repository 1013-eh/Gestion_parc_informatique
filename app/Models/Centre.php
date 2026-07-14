<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Centre extends Model
{
    protected $primaryKey = 'code_bureau';
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = ['code_bureau', 'nom_centre', 'id_region', 'matricule', 'adresse_ip', 'dernier_num_ordre', 'type_consultation'];

    public function region()
    {
        return $this->belongsTo(Region::class, 'id_region');
    }

    public function materiels()
    {
        return $this->hasMany(Materiel::class, 'code_bureau', 'code_bureau');
    }

    public function responsable()
    {
        return $this->belongsTo(User::class, 'matricule', 'matricule');
    }
}
