<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Pago;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        
        $pagos_matricula = Pago::sum('monto_total');
        $ctd_matricula = Estudiante::count('id');

        return view("home", compact('pagos_matricula', 'ctd_matricula'));
    }
}
