<!-- Modal -->
<div class="modal fade" id="modal-create-user" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Nuevo concepto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
            </div>
            <form action="{{route('conceptos.store')}}" method="POST">
              @csrf
              @method('post')
              
              <div class="modal-body">
                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Código de concepto</label>
                    <div class="col-sm-10">
                      <div class="input-group input-group-merge">
                        <span id="basic-icon-default-fullname2" class="input-group-text"><i class='bx bxs-bank'></i></span>
                        <input type="text" class="form-control" name="codigo_concepto" required placeholder="Código de concepto"  aria-describedby="basic-icon-default-fullname2">
                      </div>
                    </div>
                  </div>
                  
                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Descripción de concepto</label>
                    <div class="col-sm-10">
                      <div class="input-group input-group-merge">
                        <span id="basic-icon-default-fullname2" class="input-group-text"><i class='bx bx-pencil'></i></span>
                        <input type="text" class="form-control" name="descripcion_concepto" id="basic-icon-default-fullname" required placeholder="Descripción del concepto" aria-describedby="basic-icon-default-fullname2">
                      </div>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Monto</label>
                    <div class="col-sm-10">
                      <div class="input-group input-group-merge">
                        <span id="basic-icon-default-fullname2" class="input-group-text"><i class='bx bx-money'></i></span>
                        <input type="number" step="0.1" class="form-control" name="monto_concepto" id="basic-icon-default-fullname" min="0" required placeholder="$ Monto" aria-describedby="basic-icon-default-fullname2">
                      </div>
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