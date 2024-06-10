<!-- Modal -->
<div class="modal fade" id="modal-edit-{{$recibo->id}}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel1">Editar recibo</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

            
            <div class="modal-body">

                <form action="{{route('pagos.update', $recibo->id)}}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="col-md-12">
                        <div class="row mb-3">
                            <label class="col-form-label" >Número de control</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class='bx bxs-id-card' ></i></span>
                                <input type="number" value="{{$recibo->estudiante->numero_control}}" disabled class="form-control" placeholder="Número de control" required />
                            </div>                                   
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row mb-3">
                            <label class="col-form-label" >Estudiante</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-user"></i> </span>
                                <input type="text" value="{{$recibo->estudiante->apellido_paterno." ".$recibo->estudiante->apellido_materno." ".$recibo->estudiante->nombre}}" disabled class="form-control" placeholder="Nombres y apellidos" required />
                            </div>                                   
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row mb-3">
                            <label class="col-form-label" >Monto</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">$</span>
                                <input type="number" name="monto" id="monto" value="{{$pago_recibo}}" class="form-control" placeholder="Monto" required step="any" min="0"/>
                            </div>                                   
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

