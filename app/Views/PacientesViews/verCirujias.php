<?=$header?>
<div class="container mt-5 justify-content-center ml-3">
            <table class="table table-lg table-light">
                <thead class="thead-light">
                    <tr>
                        <th hidden="true">CirujiaId</th>
                        <th>Cirujias realizada</th>
                        <th>Fecha de realizacion</th>
                        <th>Doctor que realizó el procedimiento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($Cirujias as $Cirujia):?>
                        <tr id="datosTabla">
                            <td  hidden="true"><?=$Cirujia['CirujiaId']?></td>
                            <td><?=$Cirujia['NombreCirujia']?></td>
                            <td><?=$Cirujia['FechaCirujia']?></td>
                            <td><?=$Cirujia['DoctorACargo']?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>