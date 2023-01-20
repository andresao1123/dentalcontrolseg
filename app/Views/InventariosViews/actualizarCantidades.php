<?php if(isset($_SESSION['Rol'])): ?>
        <?php if($_SESSION['Rol']=="Administrador"):?>
    <?=$header?>
    <div class="card">
            <div class="text-center mt-5 font-weight-bold">
                <h1>Formulario Para ingresar un paciente</h1>
            </div>
            <div class="card-body">
                <h5 class="card-title text-center">Ingrese los datos del paciente</h5>
                <p class="card-text">
                    <form id="formActualizarCantidad" class="mt-3" method="post" action="<?=site_url('/actualizarCantidades')?>" enctype="multipart/form-data">
                        <label class="font-weight-bold" for="ComboConBusqueda">Seleccione el producto a agregar cantidad</label>
                        <br/>
                        <select id="ComboProductos" class="form-select " aria-label="Default select example" name="IdInventario">
                            <option selected value="-1">Seleccione un producto</option>
                            <?php foreach($inventarios as $inventario):?>
                                <option value="<?=$inventario['id_inventario'];?>"><?=$inventario['Nombre'];?></option>
                            <?php endforeach?>
                        </select>
                        <div class="form-group">
                            <label class="font-weight-bold" for="Tipo">Tipo de producto</label>
                            <input required id="Tipo" class="form-control" type="text" name="Tipo">
                        
                        <div class="form-group">
                            <label class="font-weight-bold" for="CantidadActual">Cantidad actual del producto</label>
                            <input readonly required id="CantidadActual" class="form-control" type="text" name="CantidadActual">
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="CantidadMaxima" id="CantidadMaxima">
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="CantidadMinima" id="CantidadMinima">
                        </div>
                        <div class="row justify-content-start ml-1">
                            <div>
                                <label class="font-weight-bold text-left mr-4" for="Agregar">Agregar cantidad</label>
                                <input class="form-check-input mr-5 " value="1" type="radio" id="Agregar", name="Agregar-Reducir" checked/>
                            </div>
                            <div>
                                <label class="font-weight-bold mr-4  ml-5" for="Reducir">Reducir cantidad</label>
                                <input class="form-check-input " value="2" type="radio" id="Reducir", name="Agregar-Reducir"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="CantidadAgregada-reducida">Cantidad usada o a agregar</label>
                            <input required id="CantidadAgregada-reducida" class="form-control" type="text" name="CantidadAgregada-reducida">
                        </div>
                        <button id="ActualizarProducto" class="btn btn-success mt-3" type="submit">Actualizar cantidad</button>
                    </form>
                </p>
            </div>
        </div>
    <?php elseif($_SESSION['Rol']== "Doctor"):?>
         <?=$header?>
         <div class="card">
            <div class="text-center mt-5 font-weight-bold">
                <h1>Formulario Para ingresar un paciente</h1>
            </div>
            <div class="card-body">
                <h5 class="card-title text-center">Ingrese los datos del paciente</h5>
                <p class="card-text">
                    <form id="formActualizarCantidad" class="mt-3" method="post" action="<?=site_url('/editarProducto')?>" enctype="multipart/form-data">
                    <label class="font-weight-bold" for="ComboConBusqueda">Seleccione el paciente que va a ingresar un tratamiento</label>
                        <br/>
                        <select id="ComboProductos" class="form-select " aria-label="Default select example" name="IdInventario">
                            <option selected value="-1">Seleccione un producto</option>
                            <?php foreach($inventarios as $inventario):?>
                                <option value="<?=$inventario['id_inventario'];?>"><?=$inventario['Nombre'];?></option>
                            <?php endforeach?>
                        </select>
                        <div class="form-group">
                            <label class="font-weight-bold" for="Tipo">Tipo de producto</label>
                            <input required id="Tipo" class="form-control" type="text" name="Tipo">
                        
                        <div class="form-group">
                            <label class="font-weight-bold" for="CantidadActual">Cantidad actual del producto</label>
                            <input required id="CantidadActual" class="form-control" type="text" name="CantidadActual">
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="CantidadMaxima" id="CantidadMaxima">
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="CantidadMinima" id="CantidadMinima">
                        </div>
                        <div class="row justify-content-start ml-1">
                            <div>
                                <label class="font-weight-bold text-left mr-4" for="Agregar">Agregar cantidad</label>
                                <input class="form-check-input mr-5 " value="1" type="radio" id="Agregar", name="Agregar-Reducir" checked/>
                            </div>
                            <div>
                                <label class="font-weight-bold mr-4  ml-5" for="Reducir">Reducir cantidad</label>
                                <input class="form-check-input " value="2" type="radio" id="Reducir", name="Agregar-Reducir"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="CantidadAgregada-reducida">Cantidad usada o a agregar</label>
                            <input required id="CantidadAgregada-reducida" class="form-control" type="text" name="CantidadAgregada-reducida">
                        </div>
                        <button id="CrearPaciente" class="btn btn-success mt-3" type="submit">actualizar cantidad</button>
                    </form>
                </p>
            </div>
        </div>
        <?php endif?>
    <?php endif?>
    <script type="text/javascript">
        var inventarios = <?php echo json_encode($inventarios)?>;
    </script>
</body>
</html>