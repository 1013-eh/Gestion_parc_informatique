<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materiel extends Model
{
    public function sousFamille(){
        return $this->belongsTo(SousFamille::class);
    }
}
