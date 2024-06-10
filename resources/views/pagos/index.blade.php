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
                <h5 class="card-title m-0 me-2">RECIBOS</h5>
                <!-- Button trigger modal -->
                <a href="{{route('pagos.create')}}" class="btn btn-primary" >
                    <i class='bx bx-plus'></i> Pago
                </a>
            </div>

            <div class="card-body">
                <div class="table table-responsive">
                    <table class="table tablesorter" id="example">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-white">#</th>
                                <th class="text-white">Fecha</th>
                                <th class="text-white">Recibo estudiante</th>
                                <th class="text-white">Recibo coordinación</th>
                                <th class="text-white">Numero de control</th>
                                <th class="text-white">Estudiante</th>
                                <th class="text-white">Monto</th>
                                @if (Auth::user()->rol == "Administrador")
                                    <th class="text-white">Opciones</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=0; ?>
                            @foreach ($recibos as $recibo)
                                <?php $i++; ?>
                                <tr>
                                    <td>{{$recibo->id}}</td>
                                    <td>{{ date('d/m/Y', strtotime($recibo->created_at)) }} </td>
                                    <td>
                                        <a href="{{route('recibos.estudiante_invoice', $recibo->id)}}" target="_blank" class="btn btn-sm rounded-pill btn-outline-dark">
                                            <i class='bx bxs-download'></i> Descargar
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{route('recibos.coordinacion_invoice', $recibo->id)}}" target="_blank" class="btn btn-sm rounded-pill btn-outline-dark">
                                            <i class='bx bxs-download'></i> Descargar
                                        </a>
                                    </td>
                                    <td>{{$recibo->estudiante->numero_control}}</td>
                                    <td>{{$recibo->estudiante->apellido_paterno." ".$recibo->estudiante->apellido_materno." ".$recibo->estudiante->nombre}}</td>
                                    <?php $pago_recibo = $pagos->where('recibo_id', $recibo->id)->sum('monto_total')?>
                                    <td>{{"$ ". number_format($pago_recibo, 2, '.', '')}}</td>
                                    @if (Auth::user()->rol == "Administrador")
                                        <td>
                                        {{-- <button type="button" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modal-edit-{{$recibo->id}}">
                                                <i class='bx bx-edit-alt'></i>
                                            </button> --}}
                                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modal-delete-{{$recibo->id}}">
                                                <i class='bx bx-trash'></i>
                                            </button>
                                            @include('pagos.modal-edit')
                                            @include('pagos.modal-delete')
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- <div class="card-footer">
                {{ $pagos->links() }}
            </div> --}}
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
    });
</script>
{{-- @if (count($pagos) > 0)
@endif --}}

@endsection