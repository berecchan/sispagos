<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public $meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre"];

    public function index(){
        $meses = $this->meses;        
        $mes =  date('m');
        $pagos = Pago::whereMonth('created_at',"=", $mes)->get();
    
        return view("reportes.index", compact( 'pagos', 'meses'));
    }
    
    
    public function filterByMonth(Request $request){
        
        $meses = $this->meses;
        
        $fecha_selected = $request->selected_month;
        $pagos = Pago::whereMonth('created_at',"=", $fecha_selected)->get();

        //$mes =  $request->selected_month;
        // $pagos = Pago::where('mes_pago', $fecha_selected)
        // ->whereYear('created_at', date('Y'))
        // ->get();

        return view("reportes.index", compact('pagos', 'fecha_selected', 'meses'));

    }

    public function generateReport(Request $request){
        $mes = $request->mes;
        $meses = $this->meses;

        // Encontrar los pagos de este mes con este concepto
        // Encontrar los totales este concepto
        $pagos_mes = Pago::select(DB::raw('sum(monto_total) as total, concepto_id'))
        ->whereMonth('created_at', '=', $mes)
        ->groupBy('concepto_id')
        ->get();

        $pagos_mes_anterior=  Pago::whereMonth('created_at', '=', (int)$mes-1)->get()->sum('monto_total');
        // Obtener los concepto

        // Sumar los montos totales de los conceptos con pagos
        return view('reportes.mensual', compact('mes', 'meses', 'pagos_mes', 'pagos_mes_anterior'));
    }




}
