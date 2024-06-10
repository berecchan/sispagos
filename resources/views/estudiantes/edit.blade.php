@extends('layouts.main')

@section('content')
 
    
<div class="row">

    <div class="col-md-12">
                
        @include('layouts.alerts')

        <div class="card ">

            <div class="">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Actualizar datos del estudiante</h5>
                </div>
                <form action="{{route('estudiantes.update', $estudiante->id)}}" method="POST">
                  @csrf
                  @method('put')
                  
                  <div class="modal-body">

                      <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Número control</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class='bx bxs-id-card' ></i></span>
                                <input type="text" name="numero_control" value="{{ $estudiante->numero_control }}" class="form-control" maxlength="8" minlength="8" placeholder="Número de control" required onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"/>
                            </div>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Nombres</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-user"></i></span>
                                <input type="text" name="nombre" value="{{ $estudiante->nombre }}" class="form-control" placeholder="Nombres" required/>
                            </div>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Apellido paterno</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class='bx bxs-user-detail'></i></span>
                                <input type="text" name="apellido_paterno" value="{{ $estudiante->apellido_paterno }}" class="form-control" placeholder="Apellidos" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Apellido materno</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class='bx bxs-user-detail'></i></span>
                                <input type="text" name="apellido_materno" value="{{ $estudiante->apellido_materno }}" class="form-control" placeholder="Apellidos" required/>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Género</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class='bx bx-select-multiple'></i></span>
                                <select name="genero" class="form-select" required>
                                    <option selected disabled value="">Seleccione...</option>
                                    <option value="M" @if($estudiante->genero=='M'){{'selected'}}@endif>Masculino</option>
                                    <option value="F" @if($estudiante->genero=='F'){{'selected'}}@endif>Femenino</option>                                    
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Fecha de nacimiento</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class='bx bxs-user-detail'></i></span>
                                <input type="date" name="fecha_nacimiento" value="{{ $estudiante->fecha_nacimiento }}" class="form-control" placeholder="Apellidos" required/>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2 w-100">

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Grado</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class='bx bx-food-menu' ></i></span>
                                    <input type="number" value="{{ $estudiante->grado }}" name="grado" class="form-control" maxlength="1" minlength="1" placeholder="Grado" required onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"/>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Grupo</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class='bx bx-group' ></i></span>
                                    <input type="text" value="{{ $estudiante->grupo }}" name="grupo" class="form-control" maxlength="1" minlength="1" placeholder="Grupo" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Carrera</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class='bx bx-graduation' ></i></span>
                                <input type="text" value="{{ $estudiante->carrera }}" name="carrera" class="form-control" placeholder="Carrera" required/>
                            </div>
                        </div>
                    </div>
                      
                      
                  </div>
                  <div class="modal-footer">
                      <a href="{{ route('estudiantes.index') }}" class="btn btn-outline-secondary">
                          Cancelar
                      </a>
                      <button type="submit" class="btn btn-primary">Guardar</button>
                  </div>
                </form>
            </div>
            

        </div>

        
    </div>
</div>


@endsection