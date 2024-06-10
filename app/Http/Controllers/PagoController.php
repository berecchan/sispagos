<?php

namespace App\Http\Controllers;

use App\Models\Concepto;
use App\Models\Pago; 
use App\Models\Recibo; 
use App\Traits\DeudaTrait;
use Illuminate\Http\Request;



use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;

class PagoController extends Controller
{
    use DeudaTrait;
    public $meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre"];


    public function index(){
        $recibos = Recibo::limit(200)->offset(0)->get();
        $pagos = Pago::limit(200)->offset(0)->get();
        return view('pagos.index', compact('recibos', 'pagos'));
    }

    public function create(){
        // Aqui puedo poner los conceptos y los precios
        $conceptos = Concepto::all();
        return view("pagos.create", compact('conceptos'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'estudiante_id' => 'required',
        ]);

        $recibo = new Recibo();
        $recibo->estudiante_id = $request->estudiante_id;
        $recibo->save();

        foreach ($request->data as $key => $value) {
            $concepto_id = $value[0];
            $cantidad = $value[1];
            $monto = $value[2];
            

            // Registrar el pago

            $pago = new Pago();
            $pago->estudiante_id = $request->estudiante_id;
            $pago->concepto_id = $concepto_id; 
            $pago->recibo_id = $recibo->id; 
            $pago->monto = $monto;
            $pago->cantidad = $cantidad;
            $pago->monto_total = $monto * $cantidad;
            $pago->save();

        }

        
        
        return response()->json("El pago se registró correctamente");
    }

    public function update(Request $request, Pago $pago){
        $this->validate($request, [
            'monto' => 'required',
        ]);

        $pago->monto_total = $request->monto;
        $pago->save();
        
        return redirect()->route('pagos.index')->with('success', 'Monto del pago actualizado exitosamente.');
    }

    public function destroy(Recibo $recibo){
        
        $recibo->delete();        
        return redirect()->route('pagos.index')->with('success', 'Registro eliminado exitosamente.'); 

    }


    public function generateInvoice(Pago $pago){

        $client = new Party([
            'name'          => "I.E. Tarea Completo",
            'custom_fields' => [
                'Dirección' => 'Tarea Completo',
                'RUC' => '12345654565',
                'Teléfono' => '927630025',
            ],
        ]);

        $customer = new Party([
            'name'          => $pago->matricula->estudiante->nombres_estudiante." ".$pago->matricula->estudiante->apellidos_estudiante,
            'custom_fields' => [
                'Grado y sección' =>$pago->matricula->grado." ".$pago->matricula->seccion,
                'Cod. Matrícula'=> $pago->matricula->cod_matricula,
                'Apoderado'       => $pago->matricula->apoderado->nombres_apoderado." ".$pago->matricula->apoderado->apellidos_apoderado,
            ],
        ]);

        $concepto = "";
        if ($pago->concepto == 0){
            $concepto = "Matrícula";
        }else if($pago->concepto > 0 && $pago->concepto < 13){
            $concepto = "Mensualidad: ".$this->meses[$pago->concepto - 1];
        }else{
            $concepto = "Otro";
        }

        $items = [
            (new InvoiceItem())->title($concepto)->pricePerUnit($pago->monto)->quantity(1)
        ];

        $invoice = Invoice::make('Factura')
            ->status(__('invoices::invoice.paid'))
            ->seller($client)
            ->buyer($customer)
            ->date(now())
            ->dateFormat('d/m/Y')
            ->payUntilDays(0)
            ->currencySymbol('S/')
            ->currencyCode('soles')
            ->currencyFormat('{SYMBOL} {VALUE}')
            ->currencyThousandsSeparator('.')
            ->currencyDecimalPoint(',')
            ->filename('Factura'.$pago->id)
            ->addItems($items)
            ->logo(public_path('assets/img/logo.png'))
            // You can additionally save generated invoice to configured disk
            ->save('public');

        $link = $invoice->url();
        // Then send email to party with link

        // And return invoice itself to browser or have a different view
        return $invoice->stream();
    }
}
