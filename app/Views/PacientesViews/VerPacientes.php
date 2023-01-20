<?php use App\Controllers\Pacientes;?>
<?php if(isset($_SESSION['Rol'])): ?>
        <?php if($_SESSION['Rol']=="Administrador"):?>
            <?=$header?>
                <br/>
                <br/>
                <br/>
                
                <div class="container mt-5 justify-content-center ml-3">
                    <table class="table table-lg table-light">
                        <thead class="thead-light">
                            <tr>
                                <th hidden="true">id_paciente</th> 
                                <th>Nombre del paciente</th>
                                <th>Apellido del paciente</th>
                                <th>Cedula</th>
                                <th>Numero Celular</th>
                                <th>Número fijo</th>
                                <th>Dirección de domicilio</th>
                                <th>Género</th>
                                <th>Correo electrónico</th>
                                <th>Edad</th>
                                <th>procedimientos</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php   foreach($pacientes as $paciente):?>
                                <tr id="datosTabla">
                                    <td  hidden="true"><?=$paciente['id_paciente']?></td>
                                    <td><?=$paciente['Nombre']?></td>
                                    <td><?=$paciente['Apellido']?></td>
                                    <td><?=$paciente['Cedula']?></td>
                                    <td><?=$paciente['NumCelular']?></td>
                                    <td><?=$paciente['NumFijo']?></td>
                                    <td><?=$paciente['DirDomicilio']?></td>
                                    <td><?=$paciente['Genero']?></td>
                                    <td><?=$paciente['CorreoElectronico']?></td>
                                    <td><?=$paciente['Edad'] ?></td>
                                    <td><?php if(Pacientes::verificarExistenciaAnt($paciente['id_paciente'])):?>
                                            <a id="verAntecedente" href="<?=base_url('/verAntecedente/'.$paciente['id_paciente']);?>"  class="btn btn-primary" type="button">Antecedentes</a>
                                        <?php else: ?>
                                            <a id="verAntecedente"  href="<?=base_url('/verAntecedente/'.$paciente['id_paciente']);?>"  class="btn btn-secondary disabled" type="button">Antecedentes</a>
                                        <?php endif?>
                                        <?php if(Pacientes::verificarExistenciaTrat($paciente['id_paciente'])):?>
                                            <a id="verTratamientos" href="<?=base_url('/verTratamientos/'.$paciente['id_paciente']);?>" class="btn btn-primary" type="button">Tratamientos</a>
                                        <?php else:?>
                                            <a id="verTratamientos" href="<?=base_url('/verTratamientos/'.$paciente['id_paciente']);?>" class="btn btn-secondary disabled" type="button">Tratamientos</a>
                                        <?php endif?>
                                        <?php if(Pacientes::verificarExistenciaCir($paciente['id_paciente'])):?>
                                            <a id="verCirujias" href="<?=base_url('/verCirujias/'.$paciente['id_paciente']);?>" class="btn btn-primary" type="button">Cirujías</a>
                                        <?php else:?>
                                            <a id="verCirujias"  bhref="<?=base_url('/verCirujias/'.$paciente['id_paciente']);?>" class="btn btn-secondary disabled" type="button">Cirujías</a>
                                        <?php endif?>
                                        </td>
                                    <td>
                                        <a id="EditarPaciente" href="<?=base_url('/editarPaciente/'.$paciente['id_paciente']);?>" class="btn btn-primary" type="button">Editar</a>
                                        <a id="DeletePaciente" class="DeletePaciente btn btn-danger" type="button">Borrar</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php elseif($_SESSION['Rol']== "Doctor"):?>
                    <?=$header?>
                <br/>
                <br/>
                <br/>
                
                <div class="container mt-5 justify-content-center ml-3">
                    <table class="table table-lg table-light">
                        <thead class="thead-light">
                            <tr>
                                <th hidden="true">id_paciente</th>
                                <th>Nombre del paciente</th>
                                <th>Apellido del paciente</th>
                                <th>Cedula</th>
                                <th>Numero Celular</th>
                                <th>Número fijo</th>
                                <th>Dirección de domicilio</th>
                                <th>Género</th>
                                <th>Correo electrónico</th>
                                <th>Edad</th>
                                <th>procedimientos</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php   foreach($pacientes as $paciente):?>
                                <tr id="datosTabla">
                                    <td  hidden="true"><?=$paciente['id_paciente']?></td>
                                    <td><?=$paciente['Nombre']?></td>
                                    <td><?=$paciente['Apellido']?></td>
                                    <td><?=$paciente['Cedula']?></td>
                                    <td><?=$paciente['NumCelular']?></td>
                                    <td><?=$paciente['NumFijo']?></td>
                                    <td><?=$paciente['DirDomicilio']?></td>
                                    <td><?=$paciente['Genero']?></td>
                                    <td><?=$paciente['CorreoElectronico']?></td>
                                    <td><?=$paciente['Edad'] ?></td>
                                    <td><?php if(Pacientes::verificarExistenciaAnt($paciente['id_paciente'])):?>
                                            <a id="verAntecedente" href="<?=base_url('/verAntecedente/'.$paciente['id_paciente']);?>"  class="btn btn-primary" type="button">Antecedentes</a>
                                        <?php else: ?>
                                            <a id="verAntecedente"  href="<?=base_url('/verAntecedente/'.$paciente['id_paciente']);?>"  class="btn btn-secondary disabled" type="button">Antecedentes</a>
                                        <?php endif?>
                                        <?php if(Pacientes::verificarExistenciaTrat($paciente['id_paciente'])):?>
                                            <a id="verTratamientos" href="<?=base_url('/verTratamientos/'.$paciente['id_paciente']);?>" class="btn btn-primary" type="button">Tratamientos</a>
                                        <?php else:?>
                                            <a id="verTratamientos" href="<?=base_url('/verTratamientos/'.$paciente['id_paciente']);?>" class="btn btn-secondary disabled" type="button">Tratamientos</a>
                                        <?php endif?>
                                        <?php if(Pacientes::verificarExistenciaCir($paciente['id_paciente'])):?>
                                            <a id="verCirujias" href="<?=base_url('/verCirujias/'.$paciente['id_paciente']);?>" class="btn btn-primary" type="button">Cirujías</a>
                                        <?php else:?>
                                            <a id="verCirujias"  bhref="<?=base_url('/verCirujias/'.$paciente['id_paciente']);?>" class="btn btn-secondary disabled" type="button">Cirujías</a>
                                        <?php endif?>
                                        </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif ?>
        <?php endif ?>
</body>
</html>