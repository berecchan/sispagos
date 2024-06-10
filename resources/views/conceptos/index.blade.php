@extends('layouts.main')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')

<div class="row">

    <div class="col-md-12">
                
        @include('layouts.alerts')

        <div class="card ">

            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title m-0 me-2">CONCEPTOS</h5>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-create-user" >
                    <i class='bx bx-plus'></i> Agregar Concepto
                </button>
            </div>

            <div class="card-body">
                <div class="table table-responsive">
                    <table class="table tablesorter " id="example">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-white">ID</th>
                                <th class="text-white">Código</th>
                                <th class="text-white">Descripción</th>
                                <th class="text-white">Monto</th>
                                <th class="text-white">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($conceptos as $concepto)
                                <tr>
                                    <td>{{$concepto->id}}</td>
                                    <td>{{$concepto->codigo}}</td>
                                    <td>{{$concepto->descripcion}}</td>
                                    <td>$ {{$concepto->monto}}</td>
                                    <td>                                  
                                        <a href="{{route('conceptos.edit', $concepto->id)}}" class="btn btn-sm btn-outline-warning"><i class='bx bx-edit-alt' ></i></a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modal-delete-{{$concepto->id}}">
                                            <i class='bx bx-trash'></i>
                                        </button>
                                        @include('conceptos.modal-delete')                                            
                                    </td>
                                </tr>                        
                                {{-- @include('responsable.conceptos.modal-delete') --}}
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- <div class="card-footer">
                {{ $conceptos->links() }}
            </div> --}}

        </div>

        
    </div>
</div>

@include('conceptos.modal-create')

@endsection


@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js" type="text/javascript"></script>

<script>
    $(document).ready( function () {
        $('#example').DataTable({
            "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            }
        });
    });
</script>

@endsection