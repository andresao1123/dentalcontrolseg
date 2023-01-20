<?=$header?>
<div class="text-center mt-3 font-weight-bold">
       
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="text-center">Formulario Para crear un tratamiento</h1>
            <p class="card-text">
                <h5 class="card-title text-center">Ingrese los datos del tratamiento</h5>
            
                <form id="formCrearTratamiento" class="mt-3" method="post" action="<?=site_url('/agregarTratamiento')?>" enctype="multipart/form-data">
                     <div class="form-group">    
                        <label class="font-weight-bold" for="ComboConBusqueda">Seleccione el paciente que va a ingresar un tratamiento</label>
                        <br/>
                        <select id="ComboConBusqueda" class="form-select " aria-label="Default select example" name="idHistorial">
                            <option selected value="-1">Seleccione un paciente</option>
                            <?php foreach($historiales as $historial):?>
                                <option value="<?=$historial['id_historial'];?>"><?=$historial['NombreCompleto'];?></option>
                            <?php endforeach?>
                        </select>
                     </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="Nombre">Nombre del tratamiento</label>
                        <input required id="Nombre" class="form-control" type="text" name="Nombre">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="Tipo">Tipo de tratamiento</label>
                        <input required id="Tipo" class="form-control" type="text" name="Tipo">
                    </div>
                    <div class="form-group">
                    <div class="form-group mt-3s">
                        <label class="font-weight-bold" for="Fecha de nacimiento">Fecha del tratamiento</label>
                        <input required id="FechaTrat" class="form-control" type="date" name="FechaTrat">
                    </div>
                        <label class="font-weight-bold" for="decimales">Presupuesto</label>
                        <input required id="decimales" class="form-control" type="text" name="Presupuesto">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="decimales">Abono del paciente</label>
                        <input required id="decimales" class="form-control" type="text" name="Abono">
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
                    <button id="CrearPaciente" class="btn btn-success mt-3" type="submit">Crear nuevo Tratamiento</button>
                </form>
            </p>
        </div>
    </div>
    </body>
</html>