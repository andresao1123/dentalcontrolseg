<?=$header?>
    <input type="hidden" name="idPaciente" id="idPaciente" value="<?=$pacienteId?>"/>
    <div class="container mt-5 justify-content-center ml-3">
            <table class="table table-lg table-light">
                <thead class="thead-light">
                    <tr>
                        <th hidden="true">id_tratamiento</th>
                        <th>Nombre del tratamiento</th>
                        <th>Tipo de tratamiento</th>
                        <th>Fecha del tratamiento</th>
                        <th>Costo del tratamiento</th>
                        <th>Cantidad abonada por el paciente</th>
                        <th>Saldo por pagar</th>
                        <th>Fecha del tratamiento</th>
                        <th>Forma de pago del tratamiento</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php use App\Controllers\Tratamientos;
                    foreach($tratamientos as $tratamiento):?>
                        <tr id="datosTabla">
                            <td  hidden="true"><?=$tratamiento['id_tratamiento']?></td>
                            <td><?=$tratamiento['Nombre']?></td>
                            <td><?=$tratamiento['Tipo']?></td>
                            <td><?=$tratamiento['Fecha']?></td>
                            <td><?=$tratamiento['Presupuesto']?></td>
                            <td><?=$tratamiento['Abono']?></td>
                            <td><?=$tratamiento['Saldo']?></td>
                            <td><?=$tratamiento['FechaPago']?></td>
                            <td><?=$tratamiento['FormaPago']?></td>
                            <td>
                                <?php if(Tratamientos::TieneSaldoPendiente($tratamiento['id_tratamiento'])):?>
                                    <a id="EditarTratamiento" href="<?=base_url('/editarTratamiento/'.$tratamiento['id_tratamiento'].'/'.$pacienteId);?>" class="btn btn-primary" type="button">Registrar Pago</a>
                                <?php else:?>
                                    <a id="EditarTratamiento" href="<?=base_url('/editarTratamiento/'.$tratamiento['id_tratamiento'].'/'.$pacienteId);?>" class="btn btn-secondary disabled" type="button">Registrar Pago</a>
                                <?php endif?>
                                <a id="DeleteTratamiento" class="DeleteTratamiento btn btn-danger" type="button">Borrar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>