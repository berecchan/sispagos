<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estudiantes = Estudiante::all();
        return view("estudiantes.index", compact('estudiantes'));

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
            'numero_control' => 'required|digits:8|max:8|unique:estudiantes',
            'nombre' => 'required|string',
            'apellido_paterno' => 'required|string',
            'apellido_materno' => 'required|string',
            'genero' => 'required|string',
            'fecha_nacimiento' => 'required',
            'grado' => 'required|digits:1|max:1',
            'grupo' => 'required|max:1',
            'carrera' => 'required|string' 
        ]);

        

        $user = new Estudiante();
        $user->numero_control = $request->numero_control;
        $user->nombre = $request->nombre;
        $user->apellido_paterno = $request->apellido_paterno;
        $user->apellido_materno = $request->apellido_materno;
        $user->genero = $request->genero;
        $user->fecha_nacimiento = $request->fecha_nacimiento;
        $user->grado = $request->grado;
        $user->grupo = $request->grupo;
        $user->carrera = $request->carrera;
        $user->save();

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante '.$request->nombre_usuario.' agregado exitosamente.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function show(Estudiante $estudiante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function edit(Estudiante $estudiante)
    {
        return view("estudiantes.edit", compact('estudiante'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estudiante $estudiante)
    {
        $this->validate($request, [
            'numero_control' => 'required|digits:8|max:8',
            'nombre' => 'required|string',
            'apellido_paterno' => 'required|string',
            'apellido_materno' => 'required|string',
            'genero' => 'required|string',
            'fecha_nacimiento' => 'required',
            'grado' => 'required|digits:1|max:1',
            'grupo' => 'required|max:1',
            'carrera' => 'required|string' 
        ]);

        $estudiante->numero_control = $request->numero_control;
        $estudiante->nombre = $request->nombre;
        $estudiante->apellido_paterno = $request->apellido_paterno;
        $estudiante->apellido_materno = $request->apellido_materno;
        $estudiante->genero = $request->genero;
        $estudiante->fecha_nacimiento = $request->fecha_nacimiento;
        $estudiante->grado = $request->grado;
        $estudiante->grupo = $request->grupo;
        $estudiante->carrera = $request->carrera;
        $estudiante->save();
        
        return redirect()->route('estudiantes.index')->with('success', 'Estudiante '.$request->nombre.' actualizado exitosamente.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estudiante $estudiante)
    {
        $estudiante->delete();        
        return redirect()->route('estudiantes.index')->with('success', 'Estudiante eliminado exitosamente.'); 

    }

    public function getStudentbyDNI(Request $request){
        $dni = $request->dni;
        $estudiante = Estudiante::where('dni_estudiante', $dni)->get();  
        return response()->json($estudiante);
    }

    // Está es mi función
    public function getStudentByNumeroControl(Request $request){
        $numero_control = $request->numero_control;
        $estudiante = Estudiante::where('numero_control', $numero_control)->get();
        return response()->json($estudiante);
    }

    public function getEstudianteByAula(Request $request){
        $grado = $request->grado;
        $grupo = $request->grupo;
        $carrera = $request->carrera;
        $genero = $request->genero;

        $query = Estudiante::query();
        if($grado !== null){
            $query->where('grado', $grado);
        }
        if($grupo !== null){
            $query->where('grupo', $grupo);
        }
        if($carrera !== null){
            $query->where('carrera', $carrera);
        }
        if($genero !== null){
            $query->where('genero', $genero);
        }

        $estudiantes = $query->get();
        

        return view("estudiantes.index", compact('estudiantes', 'grado', 'grupo', 'carrera', 'genero'));

    }

}
