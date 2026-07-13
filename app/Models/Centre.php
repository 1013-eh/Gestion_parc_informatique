<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Centre extends Model
{
    protected $primaryKey = 'code_bureau';

    public $incrementing = false;

    protected $fillable = [
        'code_bureau',
        'nom_centre',
        'id_region',
        'matricule',
        'adresse_ip',
        'dernier_num_ordre',
        'type_consultation',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'matricule', 'matricule');
    }
}