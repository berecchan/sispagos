@extends('layouts.main')

@section('content')

<div class="row">

    <div class="col-md-12">
                
        @include('layouts.alerts')

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <form action="{{route('pagos.store')}}" method="post" id="form-pago">
                        @csrf

                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Registrar pago</h5>
                            {{-- <small class="text-muted float-end"><i class="bx bx-star"></i></small> --}}
                        </div>

                        <div class="card-body demo-vertical-spacing demo-only-element">

                            <div class="divider">
                                <div class="divider-text"> Datos del estudiante </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Número de matricula</label>
                                        <div class="col-sm-10">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"><i class='bx bxs-id-card' ></i></span>
                                                <input type="text" name="cod_control" id="cod_control" class="form-control" required/>
                                                <input type="hidden" name="estudiante_id" id="estudiante_id" >
                                                <button class="btn btn-outline-primary" type="button" id="btn_serach_control"> <i class='bx bx-search-alt-2'></i> Buscar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" >Nombres</label>
                                        <div class="col-sm-10">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"><i class="bx bx-user"></i></span>
                                                <input type="text" name="nombre_estudiante" id="nombre_estudiante" class="form-control" required disabled/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label" for="basic-icon-default-fullname">Grado y grupo</label>
                                        <div class="col-sm-9">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"><i class="bx bxs-school"></i></span>
                                                <input type="text" name="grado_grupo" id="grado_grupo" class="form-control" placeholder="" required disabled/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label" for="basic-icon-default-fullname">Carrera</label>
                                        <div class="col-sm-9">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"><i class="bx bxs-graduation"></i></span>
                                                <input type="text" name="carrera" id="carrera" class="form-control" placeholder="" required disabled/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row mb-3">
                                        <label class="col-sm-4 col-form-label" >Género</label>
                                        <div class="col-sm-8">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"><i class="bx bxs-user"></i></span>
                                                <input type="text" name="genero" id="genero" class="form-control" required disabled/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            

                            <div class="container" id="detalles-pago" hidden >
                                <div class="divider divider-info">
                                    <div class="divider-text mb-2 text-info" >
                                        Detalles del pago
                                    </div>
                                </div>
                                
                                <div class="row row-pago"  id="row-1">
                                    <div class="col-md-4">
                                        <div class="row mb-3">
                                            <label class="col-form-label" >Concepto</label>
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"><i class="bx bx-user"></i></span>
                                                <select name="concepto-1" class="form-select concepto" id="concepto-1" required>
                                                    <option selected disabled value="">Seleccione...</option>  
                                                    @foreach ($conceptos as $concepto)
                                                        <option value="{{$concepto->id}}">{{$concepto->codigo}} - {{$concepto->descripcion}}</option>  
                                                    @endforeach                                                  
                                                </select>
                                                <input type="hidden" value="{{json_encode($conceptos)}}" class="conceptos_json" id="conceptos_json-1"/>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="row mb-3">
                                            <label class="col-form-label" >Cantidad</label>
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"><i class='bx bx-money'></i></span>
                                                <input class="cantidad" type="number" name="cantidad-1" min="0" placeholder="cantidad" id="cantidad-1" required disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="row mb-3">
                                            <label class="col-form-label" >Monto</label>
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text">$</span>
                                                <input type="number" class="monto" name="monto_total-1" id="monto_total-1" class="form-control" placeholder="Monto" required step="any" min="0" disabled />
                                                <input type="hidden" class="monto_precio" name="monto-1" id="monto-1"  class="form-control" placeholder="Monto" required step="any" min="0" />
                                                <button type="button" class="btn btn-danger" id="btn-eliminar-1">X</button>
                                            </div>                                   
                                        </div>
                                    </div>
                                    

                                </div>
                            </div>
                            <div class="align-items-end  flex-column" id="total-columna" style="display: none;">

                                <button type="button" class="btn btn-outline-info" id="btn_agregar_pago">+ Agregar concepto</button>
                                <p class="display-5 mt-4 me-4">Total: <span id="total">$ 00.00</span></p>
                            </div>

                            

                        </div>

                        <div class="card-footer text-center">
                            <a href="{{ route('pagos.index') }}" class="btn btn-outline-secondary">
                                <i class="bx bx-x"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-success" id="btn-pago" ><i class="bx bx-save"></i> Guardar</button>
                        </div>

                    </form>


                </div>

            </div>
        </div>
        
    </div>
</div>

@if ($errors->any())
    <div class="bs-toast toast toast-placement-ex m-2 fade bg-warning bottom-0 end-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
        <div class="toast-header">
            <i class='bx bx-error'></i>
            <div class="me-auto fw-semibold">Alerta</div>
            <small>Ahora</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Complete los siguientes campos
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif



@endsection


@section('js')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    
    <script src="{{ asset("assets/js/search-matricula.js") }}"></script>

    <script>
        

        $("#medio_pago").on('change', function(){

            var medio_pago = $('#medio_pago').val();
            if (medio_pago == "Caja de la IE"){
                $('#num_ticket').attr("hidden", true);
            }else{
                $('#num_ticket').attr("hidden", false);
            }

        });
        
        $("#concepto").on('change', function(){

            var concepto = $('#concepto').val();
            if (concepto == "Mensualidad"){
                $('#mensualidad_select').attr("hidden", false);
            }else{
                $('#mensualidad_select').attr("hidden", true);
            }

        });

        const formPago = document.querySelector('#form-pago');
        formPago.addEventListener('submit', (e)=>{
            e.preventDefault();
            const token = document.querySelector("input[name='_token']").value
            const estudiante_id = document.querySelector("#estudiante_id").value
            const values = []
            const rows = document.querySelectorAll('.row-pago')
            rows.forEach(row => {
                const rowNumber = row.id.charAt(row.id.length - 1)
                const concepto = row.querySelector('#concepto-' + rowNumber).value
                const cantidad = row.querySelector('#cantidad-' + rowNumber).value
                const monto = row.querySelector('#monto-' + rowNumber).value
                
                if(concepto !== null && cantidad !== null){
                    values.push([concepto, cantidad, monto])   
                }
            });

            const formData = new FormData();
            formData.append('estudiante_id', estudiante_id)
            formData.append('_token', token)
            values.forEach((row, index) => {
                row.forEach((value, colIndex) => {
                    formData.append(`data[${index}][${colIndex}]`, value);
                });
            });

            fetch("/pagos/guardar", {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.length>0){
                    window.location.href = "{{ route('pagos.index')}}"
                }
                // Handle the server response as needed
            })
            .catch(error => {
                console.error('Error sending data:', error);
            });
        })
        

    </script>


@endsection