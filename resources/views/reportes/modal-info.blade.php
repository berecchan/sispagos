<!-- Modal -->
<div class="modal fade" id="modal-info-{{$pago->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Historial de Pagos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="divider text-start divider-dashed divider-info">
                    <div class="divider-text text-info">Información del estudiante</div>
                </div>
                <div class="row mb-3">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered table-sm">

                            <tbody>
                                <tr>
                                    <td>
                                        {{-- <i class="bx bx-user"></i> --}}
                                         <strong>Estudiante</strong>
                                    </td>
                                    <td>{{$pago->estudiante->apellido_paterno." ".$pago->estudiante->apellido_paterno." ".$pago->estudiante->nombre}}</td>
                                    <td>
                                         <strong>Información</strong>
                                    </td>
                                    <td>{{ $pago->estudiante->carrera." ".$pago->estudiante->grado." ".$pago->estudiante->grupo }}</td>
                                </tr>                               
                                
                               
                            </tbody>
                        </table>
                    </div>
                </div>



                

                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                    Aceptar
                </button>
            </div>
            
        </div>
    </div>
</div>