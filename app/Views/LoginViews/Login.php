<?=$header?>
    
    <div class="card">
        <div class="card-body">
            <p class="card-text">
            <div class="text-center mt-3 font-weight-bold">
                <h1>Iniciar Sesión en el sistema</h1>
            </div>
            <?php if($error!=null):?>
                <p class="text-danger"><?=$error?></p>
            <?php else:?>
            <?php endif?>
            <form method="POST" class="needs-validation" action="<?=base_url('/login')?>">
                <div class="form-group has-validation">
                    <label class="font-weight-bold" for="username">Usuario</label>
                    <input required placeholder="Nombre de usuario o email" id="username" class="form-control" type="text" name="username">
                    <div class="invalid-feedback">
                        Ingrese un usuario
                    </div>
                </div>
                <div class="form-group has-validation">
                    <label class="font-weight-bold" for="password">Contraseña</label>
                    <input required id="password" class="form-control" type="password" name="password">
                    <div class="invalid-feedback">
                        Ingrese un usuario
                    </div>
                </div>
                <button id="IniciarSesion" class="btn btn-success mt-3" type="submit">Iniciar Sesión</button>
            </form>
            </p>
        </div>
    </div>
</body>
</html>