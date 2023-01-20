<?=$header?>
       
        <div class="card">
            <div class="card-body">
                <div class="text-center mt-3 font-weight-bold">
                    <h1>Formulario Para crear antecedentes del paciente</h1>
                </div>
                <h5 class="card-title text-center">Ingrese los antecedentes del paciente</h5>
                <p class="card-text">
                    <form id="formCrearAntecedentes" class="mt-3" method="post" action="<?=site_url('/registrarAntecedente')?>" enctype="multipart/form-data">
                        
                        <div class="form-group">
                            <input  id="cedulaPaciente" style="visibility:hidden;" value="<?= $IdPaciente;?>" class="form-control" type="text" name="IdPaciente">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="Alergias">Alergias del paciente, separar con comas si es más de una por favor</label>
                            <input required placeholder="Escriba ninguna si el paciente no posee alergias" id="Alergias" class="form-control" type="text" name="Alergias">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="Enfermedades">Enfermedades</label>
                            <input required placeholder="Escriba ninguna si el paciente no posee enfermedades" id="Enfermedades" class="form-control" type="text" name="Enfermedades">
                        
                        <div class="form-group">
                            <label class="font-weight-bold" for="Habitos">Hábitos, separar con coma cada hábito</label>
                            <input required id="Habitos" class="form-control" type="text" name="Habitos">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="Motivo">Motivo</label>
                            <input required id="Motivo" class="form-control" type="text" name="Motivo">
                        </div>
                        <div class="form-group">
                            <p class="font-weight-bold"> ¿Tiene problemas hemorrágicos?</p>
                         </div>
                        <div class="row justify-content-start ml-1">
                            <div>
                                <label class="font-weight-bold text-left mr-4" for="SiHemo">Si</label>
                                <input class="form-check-input mr-5 " value="Si" type="radio" id="SiHemo", name="Hemorragicos" />
                            </div>
                            <div>
                                <label class="font-weight-bold mr-4  ml-5" for="NoHemo">No</label>
                                <input class="form-check-input " value="No" type="radio" id="NoHemo", name="Hemorragicos" checked/>
                            </div>
                        </div>
                        <div class="form-group">
                            <p class="font-weight-bold"> ¿Tuvo alguna cirujía previa?</p>
                        </div>
                        <div id="CirujiaRadio" class="row justify-content-start ml-1">
                            <div>
                                <label class="font-weight-bold text-left mr-4" for="SiCiru">Si</label>
                                <input class="form-check-input mr-5 CirPrevia " value="Si" type="radio" id="SiCiru", name="Cirujia"/>
                            </div>
                            <div>
                                <label class="font-weight-bold mr-4  ml-5" for="NoCiru">No</label>
                                <input class="form-check-input CirPrevia " value="No" type="radio" id="NoCiru", name="Cirujia" checked/>
                            </div>
                        </div>
                        <div id="CirujiasPrevias">
                            <div class="form-group mt-3">
                                <label class="font-weight-bold" for="NombreCirujia">Ingresa el nombre de la cirujías, si es más de una separadarelas por comas</label>
                                <input id="NombreCirujia" class="form-control"  type="text" name="NombreCirujia">
                            </div>
                            <div class="form-group mt-3">
                                <label class="font-weight-bold" for="FechaCirujia">Ingresa las fechas de la cirujías, si es más de una separadarelas por comas</label>
                                <input id="FechaCirujia" class="form-control" placeholder="ej: 13/10/2020,14/11/2022" type="text" name="FechaCirujia">
                            </div>
                            <div class="form-group mt-3s">
                                <label class="font-weight-bold" for="Doctor a cargo">Ingrese los nombres de los doctres que realizaron las operaciones</label>
                                <input id="Doctor a cargo" class="form-control" type="text" name="DoctorCargo">
                            </div>
                        </div>
                        <button id="AgregarAntecedentes" class="btn btn-success mt-3" type="submit">Agregar antecedentes</button>
                    </form>
                </p>
            </div>
        </div>
    </body>
</html>