<?=$header?>
    <div class="text-center mt-3 font-weight-bold">
        <h1>Formulario Para modificar los datos de un paciente</h1>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title text-center">Ingrese los datos actualizados del paciente</h5>
            <p class="card-text">
                <form id="formActualizarPaciente" class="mt-3" method="post" action="<?=site_url('/actualizarPaciente')?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="hidden" name="id_paciente" value="<?=$Paciente['id_paciente'];?>">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="Nombre">Nombre del paciente</label>
                        <input id="Nombre" value="<?=$Paciente['Nombre'];?>" class="form-control" type="text" name="Nombre">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="Apellido">Apellido del paciente</label>
                        <input id="Apellido" value="<?=$Paciente['Apellido'];?>" class="form-control" type="text" name="Apellido">
                    
                    <div class="form-group">
                        <label class="font-weight-bold" for="NumeroCelular">Celular del paciente</label>
                        <input id="NumeroCelular" value="<?=$Paciente['NumCelular'];?>" class="form-control" type="text" name="NumCelular">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="NumeroFijo">Telefono fijo del paciente</label>
                        <input id="NumeroFijo" value="<?=$Paciente['NumFijo'];?>" class="form-control" type="text" name="NumFijo">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="DireccionDomicilio">Dirección del paciente</label>
                        <input id="DireccionDomicilio" value="<?=$Paciente['DirDomicilio'];?>" class="form-control" type="text" name="DirDomicilio">
                    </div>
                    <div class="form-group">
                        <p class="font-weight-bold"> genero del paciente</p>
                    </div>
                    <div class="row justify-content-start ml-1">
                        <?php if($Paciente['Genero']=="Masculino"):?>
                            <div>
                                <label class="font-weight-bold text-left mr-4" for="Masculino">Masculino</label>
                                <input class="form-check-input mr-5 " value="Masculino" type="radio" id="Masculino", name="Genero" checked/>
                            </div>
                            <div>
                                <label class="font-weight-bold mr-4  ml-5" for="Femenino">Femenino</label>
                                <input class="form-check-input " value="Femenino" type="radio" id="Femenino", name="Genero"/>
                            </div>
                        <?php else:?>
                            <div>
                                <label class="font-weight-bold text-left mr-4" for="Masculino">Masculino</label>
                                <input class="form-check-input mr-5 " value="Masculino" type="radio" id="Masculino", name="Genero" />
                            </div>
                            <div>
                                <label class="font-weight-bold mr-4  ml-5" for="Femenino">Femenino</label>
                                <input class="form-check-input " value="Femenino" type="radio" id="Femenino", name="Genero" checked/>
                            </div>
                        <?php endif?>
                    </div>
                    <div class="form-group mt-3">
                        <label class="font-weight-bold" for="CorreoElectronico mt-1">Ingresa el correo electrónico del paciente</label>
                        <input id="CorreoElectronico" value="<?=$Paciente['CorreoElectronico'];?>" class="form-control" placeholder="Introduce tu correo electronico" type="email" data-validation="email" name="CorreoElectronico">
                    </div>
                    <button id="EditarPaciente" class="btn btn-success mt-3" type="submit">Editar datos del paciente</button>
                </form>
            </p>
        </div>
    </div>
    </body>
</html>