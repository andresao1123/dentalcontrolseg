<?=$header?>
<div class="card">
        <div class="card-body">
            <h5 class="card-title text-center">Ingrese los datos de la cirujía</h5>
            
            <p class="card-text">
                <form id="formCrearTratamiento" class="mt-3" method="post" action="<?=site_url('/agregarCirujia')?>" enctype="multipart/form-data">
                     <div class="form-group">    
                        <label class="font-weight-bold" for="ComboConBusqueda">Seleccione el paciente que va a ingresar un tratamiento</label>
                        <br/>
                        <select id="ComboConBusqueda" class="form-select" aria-label="Default select example" name="idPaciente">
                            <option selected value="-1">Seleccione un paciente</option>
                            <?php foreach($pacientes as $paciente):?>
                                <option value="<?=$paciente['id_paciente'];?>"><?=$paciente['NombreCompleto'];?></option>
                            <?php endforeach?>
                        </select>
                     </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="NombreCirujia">Nombre de la cirujía</label>
                        <input required id="NombreCirujia" class="form-control" type="text" name="NombreCirujia">
                    </div>
                    
                    <div class="form-group mt-3s">
                        <label class="font-weight-bold" for="FechaTrat">Fecha de la cirujía</label>
                        <input required id="FechaTrat" class="form-control" type="date" name="FechaCirujia">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="DoctorACargo">Doctor a cargo de la cirujía</label>
                        <input required id="DoctorACargo" class="form-control" type="text" name="DoctorACargo">
                    </div>
                    <button id="CrearPaciente" class="btn btn-success mt-3" type="submit">Registrar nueva cirujía</button>
                </form>
            </p>
        </div>
    </div>
    </body>
</html>