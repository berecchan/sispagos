<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    public function recibos(){
        return $this->hasMany(Recibo::class);
    }

    public function pagos(){
        return $this->hasMany(Pago::class);
    }

    
}
