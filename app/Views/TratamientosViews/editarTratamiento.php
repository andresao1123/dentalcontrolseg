<?=$header?>
    <div class="text-center mt-3 font-weight-bold">
        <h1>Formulario Para modificar los datos de un paciente</h1>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title text-center">Ingrese los datos actualizados del paciente</h5>
            <p class="card-text">
                <form id="formCrearPaciente" class="mt-3" method="post" action="<?=site_url('/actualizarTratamiento')?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="hidden" name="id_paciente" value="<?=$pacienteId;?>">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="id_tratamiento" value="<?=$Tratamientos[0]['id_tratamiento'];?>">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="Nombre">Nombre del tratamiento</label>
                        <input readonly id="Nombre" value="<?=$Tratamientos[0]['Nombre'];?>" class="form-control" type="text" name="Nombre">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="Saldo">Saldo</label>
                        <input readonly id="Saldo" value="<?=$Tratamientos[0]['Saldo'];?>" class="form-control" type="text" name="Saldo">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="decimales">Abono del paciente</label>
                        <input id="abonoPaciente"class="form-control abonoPaciente" type="text" name="Abono">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="SaldoRestante">Saldo pendiente con el pago actual</label>
                        <input readonly id="SaldoRestante" class="form-control" type="text" name="SaldoPendiente">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="Forma de pago">Forma de pago del paciente</label>
                        <br/>
                        <select id="ComboTratamiento" class="form-select" aria-label="Default select example" name="FormaPago">
                            <option selected value="Null">Seleccione una forma de pago</option>
                            <option value="Efectivo">Efectivo</option>
                            <option value="Tarjeta">Tarjeta</option>
                            <option value="Transferencia">Transferencia</option>
                        </select>
                    </div>
                    <button id="ActualizarTratamiento" class="btn btn-success mt-3" type="submit">Actualizar inventario</button>
                </form>
            </p>
        </div>
    </div>
    </body>
</html>