<?= $header ?>
<?php if(isset($_SESSION['Rol'])): ?>
        <?php if($_SESSION['Rol']=="Doctor"):?>
           
            <body>
                <input type="hidden" id="Rol" value="<?php echo $_SESSION['Rol']?>">
                <script type="text/javascript" src="<?= base_url('/js/FullCalendar/main.min.js')?>"></script>
                <script type="text/javascript" src="<?= base_url('/js/FullCalendar/locales/es.js')?>"></script>
                <script type="text/javascript" src="<?= base_url('/js/moment.js')?>"></script>
                <link rel="stylesheet" href="<?=base_url('/css/FullCalendar/main.min.css');?>" />
                <link rel="stylesheet" href="<?=base_url('/css/Calendar.css');?>" />
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/free-jqgrid/4.13.5/css/ui.jqgrid.min.css">
                <script src="https://cdnjs.cloudflare.com/ajax/libs/free-jqgrid/4.13.5/js/jquery.jqgrid.min.js"></script>

                <div class="container">
                    <div id="agenda">

                    </div>
                </div>
                <!-- Button trigger modal -->
                <button hidden type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#cita">
                Launch
                </button>
                
                <!-- Modal -->
                <div class="modal fade" id="cita" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Agendar Cita</h5>
                                    <button type="button" class="close closeModal" data-dismiss="cita" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                            <form method="post" action="" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div>
                                    <label class="font-weight-bold" for="ComboDoctores">Seleccione doctor con el cual agendar la cita</label>
                                        <select id="ComboDoctores" class="form-select" aria-label="Default select example" name="IdDoctor">
                                            <option selected value="-1">Seleccione un Doctor</option>
                                            <?php foreach($doctores as $doctor):?>
                                                <option value="<?=$doctor['id_doctor'];?>"><?=$doctor['NombreCompleto'];?></option>
                                            <?php endforeach?>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="font-weight-bold" for="ComboPacientes">Seleccione el paciente que agenda  la cita</label>
                                        <select id="ComboPacientes" class="form-select" aria-label="Default select example" name="IdPaciente">
                                                <option selected value="-1">Seleccione el paciente</option>
                                                <?php foreach($pacientes as $paciente):?>
                                                    <option value="<?=$paciente['id_paciente'];?>"><?=$paciente['NombreCompleto'];?></option>
                                                <?php endforeach?>
                                        </select>
                                    </div>
                                        <div class="form-group mt-3s">
                                            <label class="font-weight-bold" for="FechaCita">Dia de la cita</label>
                                            <input required id="FechaCita" value="<?php echo date("Y-m-d");?>" class="form-control" type="date" name="FechaCita">
                                        </div>
                                        <div class="form-group mt-3s">
                                            <label class="font-weight-bold" for="horaCit">Hora de la cita</label>
                                            <input type="time" id="horaCitaCrear" name="horaCita" min="09:00" max="20:00" required>
                                        </div>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary closeModal" data-dismiss="modal">Close</button>
                                    <button id="agregarCita" type="button" class="btn btn-primary agregarCita">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Button trigger modal -->
                <button hidden type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#citaVer">
                Launch
                </button>
                
                <!-- Modal -->
                <div class="modal fade" id="citaVer" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Agendar Cita</h5>
                                    <button type="button" class="close closeModalVer" data-dismiss="cita" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                                <div class="modal-body">
                                    <div>
                                        <label class="font-weight-bold" for="Doctor">Doctor a cargo</label>
                                        <input required id="DoctorCita" class="form-control" type="text" name="Nombre">
                                    </div>
                                    <div>
                                        <label class="font-weight-bold" for="Paciente">Paciente</label>
                                        <input required id="PacienteCita" class="form-control" type="text" name="Nombre">
                                    </div>
                                        <div class="form-group mt-3s">
                                            <label class="font-weight-bold" for="FechaCita">Dia de la cita</label>
                                            <input required id="FechaCita" value="<?php echo date("Y-m-d");?>" class="form-control" type="date" name="FechaCita">
                                        </div>
                                        <div class="form-group mt-3s">
                                            <label class="font-weight-bold" for="horaCit">Hora inicio de la cita</label>
                                            <input type="time" id="horaInicioCita" name="horaCita" min="09:00" max="20:00" required>
                                        </div>
                                        <div class="form-group mt-3s">
                                            <label class="font-weight-bold" for="horaCit">Hora fin de la cita</label>
                                            <input type="time"  id="horaFinCita" name="horaCita" min="09:00" max="20:00" required>
                                        </div>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary closeModalVer" data-dismiss="modal">Close</button>
                                </div>
                        </div>
                    </div>
                </div>
            </body>
        <?php elseif($_SESSION['Rol']=="Administrador"):?>
            <body>
                <script type="text/javascript" src="<?= base_url('/js/FullCalendar/main.min.js')?>"></script>
                <script type="text/javascript" src="<?= base_url('/js/FullCalendar/locales/es.js')?>"></script>
                <script type="text/javascript" src="<?= base_url('/js/moment.js')?>"></script>
                <link rel="stylesheet" href="<?=base_url('/css/FullCalendar/main.min.css');?>" />
                <link rel="stylesheet" href="<?=base_url('/css/Calendar.css');?>" />
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/free-jqgrid/4.13.5/css/ui.jqgrid.min.css">
                <script src="https://cdnjs.cloudflare.com/ajax/libs/free-jqgrid/4.13.5/js/jquery.jqgrid.min.js"></script>
                <input type="hidden" id="Rol" value="<?php echo $_SESSION['Rol']?>">
                <div>
                    <label class="font-weight-bold" for="ComboDoctores">Seleccione de cual doctor revisar las citas</label>
                    <select id="ComboDoctoresClinica" class="form-select" aria-label="Default select example" name="IdDoctor">
                            <option selected value="-1">Seleccione un Doctor</option>
                            <?php foreach($doctores as $doctor):?>
                                     <option value="<?=$doctor['id_doctor'];?>"><?=$doctor['NombreCompleto'];?></option>
                            <?php endforeach?>
                    </select>
                </div>
                </br>
                </br>

                <div class="container">
                    <div id="agenda">

                    </div>
                </div>
                <!-- Button trigger modal -->
                <button hidden type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#cita">
                Launch
                </button>
                
                <!-- Modal -->
                <div class="modal fade" id="cita" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Agendar Cita</h5>
                                    <button type="button" class="close closeModal" data-dismiss="cita" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                            <form method="post" action="" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div>
                                        <label class="font-weight-bold" for="ComboDoctores">Seleccione doctor con el cual agendar la cita</label>
                                        <select id="ComboDoctores" class="form-select" aria-label="Default select example" name="IdDoctor">
                                            <option selected value="-1">Seleccione un Doctor</option>
                                            <?php foreach($doctores as $doctor):?>
                                                <option value="<?=$doctor['id_doctor'];?>"><?=$doctor['NombreCompleto'];?></option>
                                            <?php endforeach?>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="font-weight-bold" for="ComboPacientes">Seleccione el paciente que agenda  la cita</label>
                                        <select id="ComboPacientes" class="form-select" aria-label="Default select example" name="IdPaciente">
                                                <option selected value="-1">Seleccione el paciente</option>
                                                <?php foreach($pacientes as $paciente):?>
                                                    <option value="<?=$paciente['id_paciente'];?>"><?=$paciente['NombreCompleto'];?></option>
                                                <?php endforeach?>
                                        </select>
                                    </div>
                                        <div class="form-group mt-3s">
                                            <label class="font-weight-bold" for="FechaCita">Dia de la cita</label>
                                            <input required id="FechaCita" value="<?php echo date("Y-m-d");?>" class="form-control" type="date" name="FechaCita">
                                        </div>
                                        <div class="form-group mt-3s">
                                            <label class="font-weight-bold" for="horaCit">Hora de la cita</label>
                                            <input type="time" id="horaCitaCrear" name="horaCita" min="09:00" max="20:00" required>
                                        </div>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary closeModal" data-dismiss="modal">Close</button>
                                    <button id="agregarCita" type="button" class="btn btn-primary agregarCita">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Button trigger modal -->
                <button hidden type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#citaVer">
                Launch
                </button>
                
                <!-- Modal -->
                <div class="modal fade" id="citaVer" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Agendar Cita</h5>
                                    <button type="button" class="close closeModalVer" data-dismiss="cita" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                                <div class="modal-body">
                                    <div>
                                        <label class="font-weight-bold" for="Doctor">Doctor a cargo</label>
                                        <input required id="DoctorCita" class="form-control" type="text" name="Nombre">
                                    </div>
                                    <div>
                                        <label class="font-weight-bold" for="Paciente">Paciente</label>
                                        <input required id="PacienteCita" class="form-control" type="text" name="Nombre">
                                    </div>
                                        <div class="form-group mt-3s">
                                            <label class="font-weight-bold" for="FechaCita">Dia de la cita</label>
                                            <input required id="FechaCita" value="<?php echo date("Y-m-d");?>" class="form-control" type="date" name="FechaCita">
                                        </div>
                                        <div class="form-group mt-3s">
                                            <label class="font-weight-bold" for="horaCit">Hora inicio de la cita</label>
                                            <input type="time" id="horaInicioCita" name="horaCita" min="09:00" max="20:00" required>
                                        </div>
                                        <div class="form-group mt-3s">
                                            <label class="font-weight-bold" for="horaCit">Hora fin de la cita</label>
                                            <input type="time"  id="horaFinCita" name="horaCita" min="09:00" max="20:00" required>
                                        </div>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary closeModalVer" data-dismiss="modal">Close</button>
                                </div>
                        </div>
                    </div>
                </div>
            </body>
            
        <?php endif?>
    <?php endif?>
</html>