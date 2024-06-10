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
                
                <!---- -->
                <div class="container mb-4">
                    <div class="d-flex justify-content-between ">
                        <h5 class="card-title m-0 me-2">ESTUDIANTES</h5>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-create-estudiante" >
                            <i class='bx bx-plus'></i> Agregar estudiante
                        </button>
                    </div>

                    <div class="row" id="filtrar_matriculas">
                        <form action="{{route('filter')}}" method="post" class="d-flex flex-row align-items-center flex-wrap">
                            @csrf
                            <div class="col-md-2 p-2">
                                <div class="row mb-3">
                                    <label class="col-form-label" for="basic-icon-default-fullname">Grado</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-user"></i></span>
                                        <input type="number" name="grado" class="form-control" min="1" max="12" placeholder="Grado" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"
                                        @if(isset($grado)) value="{{$grado}}" @endif
                                        />
                                    </div>
                                </div>
                            </div>
                            
    
                            <div class="col-md-2 p-2">
                                <div class="row mb-3">
                                    <label class="col-form-label" >Grupo</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class='bx bxs-user-detail'></i></span>
                                        <input type="text" name="grupo" id="seccion" class="form-control form-control-sm"  placeholder="Grupo e.g. A"
                                        @if(isset($grupo)) value="{{$grupo}}" @endif />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 p-2">
                                <div class="row mb-3">
                                    <label class="col-form-label" >Carrera</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class='bx bxs-user-detail'></i></span>
                                        <input type="text" name="carrera" id="seccion" class="form-control form-control-sm"  placeholder="Carrera"
                                        @if(isset($carrera)) value="{{$carrera}}" @endif />
                                    </div>
                                </div>
                            </div>
    
                            <div class="col-md-2 p-2">
                                <div class="row mb-3">
                                    <label class="col-form-label" >Género</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class='bx bxs-user-detail'></i></span>
                                        @if (isset($genero))
                                        <input type="hidden" id="genero_selected" value="{{$genero}}">
                                        @endif
                                        <select  name="genero" id="genero" class="form-select form-select-sm" >
                                            <option selected disabled value="">Seleccione...</option>
                                            <option @if(isset($genero) && $genero=="M"){{"selected"}}@endif value="M">Masculino</option>
                                            <option @if(isset($genero) && $genero=="F"){{"selected"}}@endif value="F">Femenino</option>    
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="row mb-3">
                                    <label class="col-form-label" >Opción</label>
                                    <div class="input-group input-group-merge">
                                        <button type="submit" class="btn btn-sm btn-outline-success">
                                            <i class='bx bx-filter-alt'></i> Filtrar
                                        </button>
                                        @if (isset($grado) || isset($grupo) || isset($carrera) || isset($genero))
                                            <a href="{{route('estudiantes.index')}}" class="btn btn-sm btn-outline-warning">
                                                <i class='bx bx-x'></i>
                                                Quitar filtro
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <a type="button" class="btn btn-outline-dark btn-sm" onclick="PrintDiv2('table_to_print');">
                        <i class='bx bxs-file-pdf'></i> Descargar
                    </a>
                </div>

            </div>

            <div class="card-body">
                <div class="table table-responsive" id="table_to_print">
                    <table class="table tablesorter" id="example">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-white">ID</th>
                                <th class="text-white">Matrícula</th>                           
                                <th class="text-white">Nombres y apellidos</th>
                                <th class="text-white">Grado</th>
                                <th class="text-white">Grupo</th>
                                <th class="text-white">Carrera</th>
                                <th class="text-white">Género</th>
                                <th class="text-white">Fecha nacimiento</th>
                                <th class="text-white options">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($estudiantes as $estudiante)
                                <tr>
                                    <td>{{$estudiante->id}}</td>
                                    <td>{{$estudiante->numero_control}}</td>
                                    <td>{{$estudiante->nombre." ".$estudiante->apellido_paterno." ".$estudiante->apellido_materno}}</td>
                                    <td>{{$estudiante->grado}}</td>
                                    <td>{{$estudiante->grupo}}</td>
                                    <td>{{$estudiante->carrera}}</td>
                                    <td>{{$estudiante->genero}}</td>
                                    <td>{{$estudiante->fecha_nacimiento}}</td>
                                    
                                    <td class="options">                                  
                                        <a href="{{route('estudiantes.edit', $estudiante->id)}}" class="btn btn-sm btn-outline-warning"><i class='bx bx-edit-alt' ></i></a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modal-delete-{{$estudiante->id}}">
                                            <i class='bx bx-trash'></i>
                                        </button>
                                        @include('estudiantes.modal-delete')                                            
                                    </td>
                                </tr>                        
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- <div class="card-footer">
                {{ $estudiantes->links() }}
            </div> --}}
        </div>
    </div>
</div>

@include('estudiantes.modal-create')

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

<script type="text/javascript">  
   
        
    function PrintDiv() {    
        
        
        var table = $('#example').DataTable();
        table.destroy();
        
        var divToPrint = document.getElementById('table_to_print');
        
        $('*[id*=hide_in_print]:visible').each(function() {
            $(this).attr("hidden",true);
        });
        
        
        var popupWin = window.open('', '_blank', 'width=300,height=300');
        popupWin.document.open();
        
        h1 = "<h4>Matrículas</h4>";
        popupWin.document.write('<html><body onload="window.print()">' + h1 + divToPrint.innerHTML + '</html>');
            
            
        $('*[id*=hide_in_print]:hidden').each(function() {
            $(this).attr("hidden",false);
        });
        
        $('#example').DataTable();

        popupWin.document.close();

    }

    function PrintDiv2(elemId) {
    var myWindow = window.open('', 'PRINT');
    myWindow.document.write('<html><head><title> Imprimir estudiantes </title>');
    // myWindow.document.write("<link rel='stylesheet' href='{{asset('assets/css/print-styles.css')}}' media='print'>" )
    myWindow.document.write('<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">' )
    myWindow.document.write('</head><body>');
    myWindow.document.write('<h1>Estudiantes</h1>');
    const table = document.getElementById(elemId)
    const hide = table.querySelectorAll('.options')
    hide.forEach(element => {
       element.style.display="none"
    });
    myWindow.document.write(table.innerHTML);
    
    myWindow.document.write('</body></html>');
    myWindow.document.close(); // Necessary for IE >= 10
    myWindow.focus(); // Necessary for IE >= 10
    myWindow.print();
    myWindow.close();
    hide.forEach(element => {
       element.style=""
    });
    return true;
}

</script>
@endsection