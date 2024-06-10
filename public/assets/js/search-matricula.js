$(document).ready(function(){
     
    $('#btn_serach_control').click(function(){

        var control = $('#cod_control').val();
        const totalColumna = document.querySelector('#total-columna')

        // "matriculas/getMatricula"
        // TODO: Propbar esta URL con PostMan
        $.post("/estudiantes/getEstudiante",{numero_control : control, _token : $('input[name="_token"]').val()},function(res){
            if(res.length>0){
                $('#estudiante_id').val(res[0]['id'])
                $('#nombre_estudiante').val(res[0]['apellido_paterno']+" "+res[0]['apellido_materno'] + " " + res[0]['nombre'])
                $('#grado_grupo').val(res[0]['grado']+"  "+res[0]['grupo'])
                $('#carrera').val(res[0]['carrera'])
                $('#genero').val(res[0]['genero'])


                $('#detalles-pago').attr("hidden",false);
                $('#btn-pago').attr("disabled",false);
                totalColumna.style.display='flex'
                // Fix this
                
            }else{
                $('#numero_control').val('')
                $('#nombre_estudiante').val('')
                $('#grado_grupo').val('')
                $('#carrera').val('')
                $('#genero').val('')
                $('#detalles-pago').attr("hidden",true);
                totalColumna.style.display='none'
            }
        });

    });
    
    // ------------------

    const formatCurrency = (amount) =>{
        return new Intl.NumberFormat('en-Us', {
            style: 'currency',
            currency: 'USD'
        }).format(amount)
    }

    const detallesPago = document.querySelector('#detalles-pago')
    const pagosRow = document.querySelector('#row-1')
    const btnAgregarPago = document.querySelector('#btn_agregar_pago')
    document.querySelector('#btn-eliminar-1').addEventListener('click', eliminarFila)
    let numberOfRows = 1

    btnAgregarPago.addEventListener('click', ()=>{
        // Agregar una nueva fila de pago
        numberOfRows++
        const newRow = document.createElement('div')
        newRow.className = 'row'
        newRow.id = 'row'+numberOfRows

        newRow.innerHTML = pagosRow.innerHTML
        newRow.id = "row-" + numberOfRows
        newRow.classList.add("row-pago")

        const concepto = newRow.querySelector('#concepto-1')
        const conceptosJson = newRow.querySelector('#conceptos_json-1')
        const cantidad = newRow.querySelector('#cantidad-1')
        const monto = newRow.querySelector('#monto-1')
        const monto_total = newRow.querySelector('#monto_total-1')
        const btnEliminar = newRow.querySelector('#btn-eliminar-1')

        concepto.id = 'concepto-' + numberOfRows
        conceptosJson.id = 'conceptos_json-' + numberOfRows
        cantidad.id = 'cantidad-' + numberOfRows
        monto.id = 'monto-' + numberOfRows
        monto_total.id = 'monto_total-' + numberOfRows
        btnEliminar.id = 'btn-eliminar-' + numberOfRows

        concepto.name = 'concepto-' + numberOfRows
        cantidad.name = 'cantidad-' + numberOfRows
        monto.name = 'monto-' + numberOfRows
        monto_total.name = 'monto_total-' + numberOfRows

        cantidad.disabled= true;

        concepto.addEventListener('change', cambiarMonto)
        cantidad.addEventListener('change', actualizarTotal)
        btnEliminar.addEventListener('click', eliminarFila)
        detallesPago.append(newRow)
    })

    // --------------------

    const concepto1 = document.querySelector('#concepto-1')
    const cantidad1 = document.querySelector('#cantidad-1')
    cantidad1.addEventListener('change', actualizarTotal)
    concepto1.addEventListener('change', cambiarMonto)

    function cambiarMonto(e){
        // Identificar el número de fila
        const rowNumber = e.target.id.charAt(e.target.id.length - 1)

        const conceptos = document.querySelector('#conceptos_json-' + rowNumber).value
        const cantidad = document.querySelector('#cantidad-' + rowNumber)
        const monto = document.querySelector('#monto-' + rowNumber)
        const montoTotal = document.querySelector('#monto_total-' + rowNumber)
        const conceptos_json = JSON.parse(conceptos)

        const conceptoSeleccionado = conceptos_json.filter(concepto => concepto.id == e.target.value)[0]
        monto.value = conceptoSeleccionado.monto
        cantidad.disabled = false;
        cantidad.value= 1
        montoTotal.value= conceptoSeleccionado.monto;
        cantidad.addEventListener('change', (e)=>{
            // Cambiar el monto
            montoTotal.value = Number(e.target.value) * Number(conceptoSeleccionado.monto)
            actualizarTotal()
        }) 
        actualizarTotal()
    }

    function actualizarTotal(){
        const montos = document.querySelectorAll('.monto')
        const totalLabel = document.querySelector('#total')
        let total = 0
        montos.forEach(monto =>{
            total += Number(monto.value)
        })
        
        totalLabel.textContent = formatCurrency(total)
    }

    function eliminarFila(e){
        const rowNumber = e.target.id.charAt(e.target.id.length - 1)
        const row = document.querySelector('#row-' + rowNumber)
        if(rowNumber === 1){
            alert('No se puede eliminar el primer elemento del pago')
        }
        row.remove();
        actualizarTotal()
    }

});
