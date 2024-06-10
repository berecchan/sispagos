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
                <h5 class="card-title m-0 me-2">Reporte Pagos: @if(isset($fecha_selected)){{ $meses[$fecha_selected-1] }} @else {{ $meses[date('m')-1]}}@endif</h5>
                <div>
                    
                    <a type="button" class="btn btn-outline-dark btn-sm" href="{{route('reportesMensuales', isset($fecha_selected) ? $fecha_selected : (int)date('m'))}}">
                        <i class='bx bxs-file-pdf'></i> Descargar
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="row col d-flex" id="filtrar_pagos">

                    <form action="{{route('filtermonth')}}" method="post" class="d-flex flex-row align-items-center flex-wrap">
                        @csrf
                        <div class="col-md-3">
                            <div class="row mb-3">
                                <label class="col-form-label" for="basic-icon-default-fullname">Mes</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-user"></i></span>
                                    <select name="selected_month" id="selected_month" class="form-select form-select-sm" required>
                                        @for ($i = 0; $i < count($meses); $i++)
                                            @if (isset($fecha_selected))
                                                <option @if( $fecha_selected== $i+1) {{'selected'}}@endif value="{{$i+1}}">{{$meses[$i]}}</option>
                                            @else
                                                <option @if(date("m") == $i+1 ){{"selected"}}@endif value="{{$i+1}}">{{$meses[$i]}}</option>
                                            @endif
                                        @endfor
                                        
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="row mb-3">
                                <label class="col-form-label" >Opción</label>
                                <div class="input-group input-group-merge">
                                    <button type="submit" class="btn btn-sm btn-outline-success">
                                        <i class='bx bx-filter-alt'></i> Filtrar
                                    </button>
                                    @if (isset($nivel))
                                        <a href="{{route('matriculas.index')}}" class="btn btn-sm btn-outline-warning">
                                            <i class='bx bx-x'></i>
                                            Quitar filtro
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                



                <div class="table table-responsive" id="table_to_print">
                    <table class="table tablesorter " id="example">
                        <thead>
                            <tr class="table-dark">
                                <th class="text-white">Id</th>
                                <th class="text-white">Estudiante</th>
                                <th class="text-white">Concepto</th>
                                <th class="text-white">Cantidad</th>
                                <th class="text-white">Precio unitario</th>
                                <th class="text-white">Precio total</th>
                                <th class="text-white">Fecha</th>
                                <th class="text-white" id="hide_in_print">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pagos as $pago)
                                <tr>
                                    <td>{{$pago->id}}</td>
                                    <td>{{$pago->estudiante->apellido_paterno." ".$pago->estudiante->apellido_materno." ".$pago->estudiante->nombre}}</td>
                                    <td>{{$pago->concepto->codigo." - ".$pago->concepto->descripcion}}</td>
                                    <td>{{$pago->cantidad}}</td>
                                    <td>{{$pago->monto}}</td>
                                    <td>{{$pago->monto_total}}</td>
                                    <td>{{$pago->created_at->format('Y-m-d')}}</td>
                                    
                                    <td id="hide_in_print">
                                        @if (count($pagos) >0 )
                                            <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#modal-info-{{$pago->id}}">
                                                <i class='bx bx-list-ul'></i> Todos los pagos
                                            </button>
                                            @include('reportes.modal-info')
                                        @else
                                            <span class="badge bg-label-info me-1"><i class="bx bx-info"></i> Aún no hay pagos</span>
                                        @endif                                            
                                    </td>
                                </tr>                        
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


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

        let mes = $("#selected_month").val();

    });

    $("#selected_month").on("change", function (){
        let mes = $("#selected_month").val();

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
        let mes = $("#selected_month").val();
        h1 = "<h4>Pagos correspondiente al mes: " + mes + "</h4>";
        popupWin.document.write('<html><body onload="window.print()">' + h1 + divToPrint.innerHTML + '</html>');
            
            
        $('*[id*=hide_in_print]:hidden').each(function() {
            $(this).attr("hidden",false);
        });
        
        $('#example').DataTable();

        popupWin.document.close();

    }
</script>
@endsection
