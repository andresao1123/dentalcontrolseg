<?=$header?>
    <body>
       

    <div class="card">
        <div class="text-center mt-5 font-weight-bold">
            <h1>Formulario Para ingresar un paciente</h1>
        </div>
        <div class="card-body">
            <h5 class="card-title text-center">Ingrese los datos del paciente</h5>
            <p class="card-text">
                <form id="formCrearPaciente" class="mt-3" method="post" action="<?=site_url('/nuevoPaciente')?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="font-weight-bold" for="Nombre">Nombre del paciente</label>
                        <input required id="Nombre" class="form-control" type="text" name="Nombre">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="Apellido">Apellido del paciente</label>
                        <input required id="Apellido" class="form-control" type="text" name="Apellido">
                    
                    <div class="form-group">
                        <label class="font-weight-bold" for="Cedula">Numero de cedula</label>
                        <input required id="Cedula" class="form-control" type="text" name="Cedula">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="NumeroCelular">Celular del paciente</label>
                        <input required id="NumeroCelular" class="form-control" type="text" name="NumCelular">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="NumeroFijo">Telefono fijo del paciente</label>
                        <input required id="NumeroFijo" class="form-control" type="text" name="NumFijo">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="DireccionDomicilio">Dirección del paciente</label>
                        <input required id="DireccionDomicilio" class="form-control" type="text" name="DirDomicilio">
                    </div>
                    <div class="form-group">
                        <p class="font-weight-bold"> genero del paciente</p>
                    </div>
                    <div class="row justify-content-start ml-1">
                        <div>
                            <label class="font-weight-bold text-left mr-4" for="Masculino">Masculino</label>
                            <input class="form-check-input mr-5 " value="Masculino" type="radio" id="Masculino", name="Genero" checked/>
                        </div>
                        <div>
                            <label class="font-weight-bold mr-4  ml-5" for="Femenino">Femenino</label>
                            <input class="form-check-input " value="Femenino" type="radio" id="Femenino", name="Genero"/>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <label class="font-weight-bold" for="CorreoElectronico mt-1">Ingresa el correo electrónico del paciente</label>
                        <input required id="CorreoElectronico" class="form-control" placeholder="Introduce tu correo electronico" type="email" data-validation="email" name="CorreoElectronico">
                        <div id="xmail" class="d-none"><h6 class="text-danger">Ingresa un email valido</h6></div>
                    </div>
                    <div class="form-group mt-3s">
                        <label class="font-weight-bold" for="Fecha de nacimiento">Ingrese su fecha de nacimiento</label>
                        <input required id="Fecha de nacimiento" value="<?php echo date("Y-m-d\TH-i");?>" class="form-control" type="date" name="FechaNac">
                    </div>
                    <div class="form-group">
                        <p class="font-weight-bold"> ¿Necesita crear antecedentes?</p>
                    </div>
                    <div class="row justify-content-start ml-1">
                        <div>
                            <label class="font-weight-bold text-left mr-4" for="SiAnt">Si</label>
                            <input class="form-check-input mr-5 " value="true" type="radio" id="SiAnt", name="NecesitaAnt" checked/>
                        </div>
                        <div>
                            <label class="font-weight-bold mr-4  ml-5" for="NoAnt">No</label>
                            <input class="form-check-input " value="false" type="radio" id="NoANt", name="NecesitaAnt"/>
                        </div>
                    </div>
                    <button id="CrearPaciente" class="btn btn-success mt-3" type="submit">Crear nuevo paciente</button>
                </form>
            </p>
        </div>
    </div>
    </body>
</html>