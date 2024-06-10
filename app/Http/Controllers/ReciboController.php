<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recibo; 
use App\Models\Pago; 

class ReciboController extends Controller
{
    public function generateStudentInvoice(Recibo $recibo){
        $pagos_recibo = Pago::where('recibo_id', $recibo->id)->get();
        $total_recibo = $pagos_recibo->sum('monto_total');
        return view('recibos.alumno', compact('recibo', 'pagos_recibo', 'total_recibo'));
    }
    
    public function generateCoordinacionInvoice(Recibo $recibo){
        $pagos_recibo = Pago::where('recibo_id', $recibo->id)->get();
        $total_recibo = $pagos_recibo->sum('monto_total');
        return view('recibos.coordinacion', compact('recibo', 'pagos_recibo', 'total_recibo'));
        
    }
}
