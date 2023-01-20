<?=$header?>
        <div class="container mt-5 justify-content-center ml-3">
                <table class="table table-lg table-light">
                    <thead class="thead-light">
                        <tr>
                            <th hidden="true">AntecedentesId</th>
                            <th>Alergias</th>
                            <th>Enfermedades</th>
                            <th>Habitos</th>
                            <th>Motivo</th>
                            <th>CirujíasPrevias</th>
                            <th>Problemas Hemorragicos</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($antecedentes as $antecedente):?>
                            <tr id="datosTabla">
                                <td  hidden="true"><?=$antecedente['AntecedentesId']?></td>
                                <td><?=$antecedente['Alergias']?></td>
                                <td><?=$antecedente['Enfermedades']?></td>
                                <td><?=$antecedente['Habitos']?></td>
                                <td><?=$antecedente['Motivo']?></td>
                                <td><?=$CirujiasPrevias?></td>
                                <td><?=$ProblemasHemorragicos?></td>
                                <td>
                                    <a id="DeleteAntecedente" href="<?=base_url('/borrarAntecedente/'.$antecedente['AntecedentesId']);?>" class="btn btn-danger" type="button">Borrar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
    </body>
</html>