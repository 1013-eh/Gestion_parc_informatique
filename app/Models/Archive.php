<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    protected $table = 'archives';
    protected $primaryKey = 'id_archive';

    protected $fillable = [
        'num_serie',
        'description',
        'date_archivage',
    ];
    public function materiel()
    {
    return $this->belongsTo(Materiel::class, 'num_serie', 'num_serie');
    }
}