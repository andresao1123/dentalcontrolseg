<?=$header?>
    <div class="text-center mt-3 font-weight-bold">
        <h1>Formulario Para modificar los datos de un doctor</h1>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title text-center">Ingrese los datos actualizados del doctor</h5>
            <p class="card-text">
                <form id="formActualizarDoctor" class="mt-3" method="post" action="<?=site_url('/actualizarDoctor')?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="hidden" name="id_paciente" value="<?=$Doctor['id_doctor'];?>">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="Nombre">Nombre del doctor</label>
                        <input id="Nombre" value="<?=$Doctor['Nombre'];?>" class="form-control" type="text" name="Nombre">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="Apellido">Apellido del doctor</label>
                        <input id="Apellido" value="<?=$Doctor['Apellido'];?>" class="form-control" type="text" name="Apellido">
                    
                    <div class="form-group">
                        <label class="font-weight-bold" for="Especialidad">Especialidad del doctor</label>
                        <input id="Especialidad" value="<?=$Doctor['Especialidad'];?>" class="form-control" type="text" name="Especialidad">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="NumeroCelular">Celular del doctor</label>
                        <input id="NumeroCelular" value="<?=$Doctor['NumCelular'];?>" class="form-control" type="text" name="NumCelular">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="NumeroFijo">Telefono fijo del doctor</label>
                        <input id="NumeroFijo" value="<?=$Doctor['NumFijo'];?>" class="form-control" type="text" name="NumFijo">
                    </div>
                    <div class="form-group">
                        <p class="font-weight-bold"> genero del doctor</p>
                    </div>
                    <div class="row justify-content-start ml-1">
                        <?php if($Doctor['Genero']=="Masculino"):?>
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
                        <input id="CorreoElectronico" value="<?=$Doctor['CorreoElectronico'];?>" class="form-control" placeholder="Introduce tu correo electronico" type="email" data-validation="email" name="CorreoElectronico">
                    </div>
                    <button id="EditarPaciente" class="btn btn-success mt-3" type="submit">Editar datos del doctor</button>
                </form>
            </p>
        </div>
    </div>
    </body>
</html>