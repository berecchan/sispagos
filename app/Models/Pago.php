<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    public function estudiante(){
        return $this->belongsTo(Estudiante::class);
    }

    public function recibos(){
        return $this->hasMany(Recibo::class);
    }

    public function concepto(){
        return $this->belongsTo(Concepto::class);
    }

}
