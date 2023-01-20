<?=$header?>
    <body>
       

    <div class="card">
        <div class="text-center mt-5 font-weight-bold">
            <h1>Formulario para agregar un doctor</h1>
        </div>
        <div class="card-body">
            <h5 class="card-title text-center">Ingrese los datos del doctor</h5>
            <p class="card-text">
                <form id="formCrearPaciente" class="mt-3" method="post" action="<?=site_url('/agregarDoctor')?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="font-weight-bold" for="Nombre">Nombre del doctor</label>
                        <input required id="Nombre" class="form-control" type="text" name="Nombre">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="Apellido">Apellido del doctor</label>
                        <input required id="Apellido" class="form-control" type="text" name="Apellido">
                    
                    <div class="form-group">
                        <label class="font-weight-bold" for="Cedula">Numero de cedula</label>
                        <input required id="Cedula" class="form-control" type="text" name="Cedula">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="Especialidad">Especialidad del doctor</label>
                        <input required id="Especialidad" class="form-control" type="text" name="Especialidad">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="NumeroCelular">Celular del doctor</label>
                        <input required id="NumeroCelular" class="form-control" type="text" name="NumCelular">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="NumeroFijo">Telefono fijo del doctor</label>
                        <input required id="NumeroFijo" class="form-control" type="text" name="NumFijo">
                    </div>
                    <div class="form-group">
                        <p class="font-weight-bold"> genero del doctor</p>
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
                    <?php if($email == null):?>
                        <div class="form-group mt-3">
                            <label class="font-weight-bold" for="CorreoElectronico mt-1">Ingresa el correo electrónico del doctor</label>
                            <input required id="CorreoElectronico" class="form-control" placeholder="Introduce tu correo electronico" type="email" data-validation="email" name="CorreoElectronico">
                            <div id="xmail" class="d-none"><h6 class="text-danger">Ingresa un email valido</h6></div>
                        </div>
                    <?php else: ?>
                        <div class="form-group mt-3">
                            <label class="font-weight-bold" for="CorreoElectronico mt-1">Ingresa el correo electrónico del doctor</label>
                            <input required id="CorreoElectronico" value="<?=$email;?>" class="form-control" placeholder="Introduce tu correo electronico" type="email" data-validation="email" name="CorreoElectronico">
                            <div id="xmail" class="d-none"><h6 class="text-danger">Ingresa un email valido</h6></div>
                        </div>
                    <?php endif?>
                    <div class="form-group mt-3s">
                        <label class="font-weight-bold" for="Fecha de nacimiento">Ingrese su fecha de nacimiento</label>
                        <input required id="Fecha de nacimiento" value="<?php echo date("Y-m-d\TH-i");?>" class="form-control" type="date" name="FechaNac">
                    </div>
                    <button id="CrearDoctor" class="btn btn-success mt-3" type="submit">Crear nuevo Doctor</button>
                </form>
            </p>
        </div>
    </div>
    </body>
</html>