<?php

namespace App\Http\Controllers;

use App\Models\Concepto;
use Illuminate\Http\Request;

class ConceptoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conceptos = Concepto::all();
        return view("conceptos.index", compact('conceptos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'codigo_concepto' => 'required|string',
            'descripcion_concepto' => 'required|string',
            'monto_concepto' => 'required|numeric|min:0',
        ]);

        $concepto = new Concepto();
        $concepto->codigo = $request->codigo_concepto;
        $concepto->descripcion = $request->descripcion_concepto;
        $concepto->monto = $request->monto_concepto;
        $concepto->save();

        return redirect()->route('conceptos.index')->with('success', 'Concepto '.$request->codigo.' registrado exitosamente.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Concepto  $banco
     * @return \Illuminate\Http\Response
     */
    public function show(Concepto $banco)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Concepto  $banco
     * @return \Illuminate\Http\Response
     */
    public function edit(Concepto $concepto)
    {
        return view("conceptos.edit", compact('concepto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Concepto  $banco
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Concepto $concepto)
    {
        $this->validate($request, [
            'codigo' => 'required|string',
            'descripcion' => 'required|string',
            'monto' => 'required|decimal|min:0',
        ]);

        $concepto->codigo = $request->codigo;
        $concepto->descripcion = $request->descripcion;
        $concepto->monto = $request->monto;
        $concepto->save();
        
        return redirect()->route('conceptos.index')->with('success', 'Concepto '.$concepto->codigo.' actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Concepto  $banco
     * @return \Illuminate\Http\Response
     */
    public function destroy(Concepto $concepto)
    {
        $concepto->delete();
        return redirect()->route('conceptos.index')->with('success', 'Concepto eliminado exitosamente.'); 
    }
}
