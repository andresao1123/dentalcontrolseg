<?=$header?>
    <div class="container mt-5 justify-content-center ml-3">
    <?php use App\Controllers\Tratamientos;?>
        <?php if(isset( $Doctores) && sizeof($Doctores)>0):?>
            <table class="table table-lg table-light">
                <thead class="thead-light">
                    <tr>
                        <th hidden="true">id_doctor</th>
                        <th>Nombre del doctor</th>
                        <th>Genero</th>
                        <th>Cedula del doctor</th>
                        <th>Especialidad del doctor</th>
                        <th>Correo electrónico del doctor</th>
                        <th>Numero Celular</th>
                        <th>Número fijo</th>
                        <th>Fecha de nacimiento del doctor</th>
                        <th>Edad del doctor</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($Doctores as $Doctor):?>
                        <tr id="datosTabla">
                            <td  hidden="true"><?=$Doctor['id_doctor']?></td>
                            <td><?=$Doctor['NombreCompleto']?></td>
                            <td><?=$Doctor['Genero']?></td>
                            <td><?=$Doctor['Cedula']?></td>
                            <td><?=$Doctor['Especialidad']?></td>
                            <td><?=$Doctor['CorreoElectronico']?></td>
                            <td><?=$Doctor['NumCelular']?></td>
                            <td><?=$Doctor['NumFijo']?></td>
                            <td><?=$Doctor['FechaNac']?></td>
                            <td><?=$Doctor['Edad']?></td>   
                            <td>
                                <a id="EditarDoctor" href="<?=base_url('/editarDoctor/'.$Doctor['id_doctor']);?>" class="btn btn-primary" type="button">Editar Doctor</a>
                                <a id="DeleteDoctor" class="DeleteDoctor btn btn-danger" type="button">Borrar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else:?>
                <div class="centered">
                    <h1  class="text-danger ">No hay datos</h1>
                </div>
        <?php endif?>
        </div>
    </body>
</html>