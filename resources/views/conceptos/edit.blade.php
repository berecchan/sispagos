@extends('layouts.main')

@section('content')
 
    
<div class="row">

    <div class="col-md-12">
                
        @include('layouts.alerts')

        <div class="card ">

            <div class="">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Editar concepto</h5>
                </div>
                <form action="{{route('conceptos.update', $concepto->id)}}" method="POST">
                  @csrf
                  @method('put')
                  
                  <div class="modal-body">
                      <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Código concepto</label>
                        <div class="col-sm-10">
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text"><i class='bx bs-bank'></i></span>
                            <input type="text" class="form-control" name="codigo" value="@if(!old('codigo')){{$concepto->codigo}}@else{{old('codigo')}}@endif"  id="basic-icon-default-fullname" required placeholder="Código del concepto" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2">
                          </div>
                        </div>
                      </div>
                      
                      <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Descripción</label>
                        <div class="col-sm-10">
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text"><i class='bx bx-pencil'></i></span>
                            <input type="text" class="form-control" name="descripcion" value="@if(!old('descripcion')){{$concepto->descripcion}}@else{{old('descripcion')}}@endif"  required placeholder="Descripción del concepto" aria-describedby="basic-icon-default-fullname2">
                          </div>
                        </div>
                      </div>
    
                      <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Monto</label>
                        <div class="col-sm-10">
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text"><i class='bx bx-money'></i></span>
                            <input type="number" min="0" class="form-control" name="monto" value="@if(!old('monto')){{$concepto->monto}}@else{{old('monto')}}@endif"  required placeholder="Monto $" aria-describedby="basic-icon-default-fullname2">
                          </div>
                        </div>
                      </div>    
                      
                  </div>
                  <div class="modal-footer">
                      <a href="{{ route('conceptos.index') }}" class="btn btn-outline-secondary">
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