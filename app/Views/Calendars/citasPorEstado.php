<?= $header ?>

<body>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/cupertino/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/free-jqgrid/4.13.5/css/ui.jqgrid.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/free-jqgrid/4.13.5/js/jquery.jqgrid.min.js"></script>
    <script src="<?= base_url('/js/select2.min.js'); ?>"></script>
    <br />
    <select id="ComboCitasClinica" class="form-select w-75" aria-label="Default select example" name="Estado">
        <option selected value="Ninguna">Seleccione un Estado</option>
        <option value="Cancelada">Cancelada</option>
        <option value="Pendiente">Pendiente</option>
        <option value="Confirmada">Confirmada</option>
        <option value="Completa">Completa</option>
    </select>
    </div>
    <br />
    <div class="container mt-5 justify-content-center ml-3">
        <table id="CitasEstado" class="display" cellspacing="0" width="2000px">
        </table>
        <div id="pager2"></div>
    </div>
</body>

</html>