<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $TituloPagina ?></title>
    <link rel="stylesheet" href="<?= base_url('/css/bootstrap.min.css'); ?>" />
    <link rel="stylesheet" href="<?= base_url('/css/site.css'); ?>" />
    <link rel="stylesheet" href="<?= base_url('/css/jquery-ui.min.css'); ?>" />
    <link rel="stylesheet" href="<?= base_url('/css/select2.min.css'); ?>" />
    <link rel="stylesheet" href="<?= base_url('/fontAwesome/css/all.css'); ?>" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600|Open+Sans" rel="stylesheet">
    


    <script src="<?= base_url('/fontAwesome/js/all.js'); ?>"></script>
    <script src="<?= base_url('/js/jquery-3.5.1.min.js'); ?>"></script>
    <script src="<?= base_url('/js/jquery-ui.min.js'); ?>"></script>
    <script src="<?= base_url('/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?= base_url('/js/Site.js'); ?>"></script>
    <script src="<?= base_url('/js/select2.min.js'); ?>"></script>
    <!-- <link rel="stylesheet" href="//css/bootstrap.min.css" />
    <link rel="stylesheet" href="//css/site.css"/>
    <link rel="stylesheet" href="//css/jquery-ui.min.css" />
    <link rel="stylesheet" href="//css/select2.min.css" />
    <script src="//js/jquery-3.5.1.min.js"></script>
    <script src="//js/jquery-ui.min.js"></script>
    <script src="//js/bootstrap.bundle.min.js"></script>
    <script src="//js/Site.js"></script>
    <script src="//js/select2.min.js"></script> -->
</head>

<body>
    </nav>
    <?php if (!isset($_SESSION['usuario'])) : ?>
        <?php if ($_SESSION['Rol'] == "Administrador") : ?>
            <nav class="navbar navbar-expand-md navbar-dark scrolling navbar pt-3">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/">DentalControl</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#NavbarDarkDropdown" aria-controls="#NavbarDarkDropdown" aria-expanded="false" aria-label="Toggle Navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="NavbarDarkDropdown">
                        <ul class="navbar-nav ml-5 mr-auto">
                            <li class="nav-item dropdown" type="button"><a href="#" class="nav-link dropdown-toggle text-white pl-h" data-toggle="dropdown">Pacientes</a>
                                <div class="dropdown-menu fade-down">
                                    <a class="dropdown-item" href="<?= base_url('/verPacientes?error=false'); ?>">Ver Pacientes</a>
                                    <a class="dropdown-item" href="<?= base_url('/crearPaciente'); ?>">Crear una nueva Historia Clinica</a>
                                    <a class="dropdown-item" href="<?= base_url('/crearTratamiento'); ?>">Crear un tratamiento</a>
                                    <a class="dropdown-item" href="<?= base_url('/registrarCirujia'); ?>">Registrar una Cirujía</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown" type="button"><a href="#" class="nav-link dropdown-toggle text-white pl-h" data-toggle="dropdown">Doctores</a>
                                <div class="dropdown-menu fade-down">
                                    <a class="dropdown-item" href="<?= base_url('/verDoctores'); ?>">Ver Doctores de la clinica</a>
                                    <a class="dropdown-item" href="<?= base_url('/registrarDoctor'); ?>">Agregar un doctor a la clinica</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown" type="button"><a href="#" class="nav-link dropdown-toggle text-white pl-h" data-toggle="dropdown">Inventario</a>
                                <div class="dropdown-menu fade-down">
                                    <a class="dropdown-item" href="<?= base_url('/verInventarios'); ?>">Ver Inventario</a>
                                    <a class="dropdown-item" href="<?= base_url('/registrarProducto'); ?>">Agregar un nuevo producto</a>
                                    <a class="dropdown-item" href="<?= base_url('/actualizarProducto'); ?>">Actualizar cantidades</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown fade-down" type="button"><a href="#" class="nav-link dropdown-toggle text-white pl-h" data-toggle="dropdown">Calendarios y Citas</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="<?= base_url('/verCalendario'); ?>">Ver el calendario</a>
                                    <a class="dropdown-item" href="<?= base_url('/verCitasPorEstado'); ?>">Ver todas las citas</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown fade-down" type="button"><a href="#" class="nav-link dropdown-toggle text-white pl-h" data-toggle="dropdown">Reporteria</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" asp-area="" asp-controller="Paciente" asp-action="Index">Reportes diarios</a>
                                    <a class="dropdown-item" asp-area="" asp-controller="Paciente" asp-action="Index">reportes</a>
                                </div>
                            </li>

                        </ul>
                    </div>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="btn-nav" type="button"><a href="<?= base_url('/logout') ?>" class="btn btn-primary navbar-btn">Cerrar Sesión</a>

                        </li>
                    </ul>
                </div>
                </div>
                </div>
            </nav>
            </nav>
        <?php elseif ($_SESSION['Rol'] == "Doctor") : ?>
            <nav class="navbar navbar-expand-md navbar-dark scrolling navbar pt-3">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/">DentalControl</a>
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#NavbarDarkDropdown">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="NavbarDarkDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown " type="button"><a href="#" class="nav-link dropdown-toggle text-white pl-h" data-toggle="dropdown">Pacientes</a>
                                <div class="dropdown-menu fade-down">
                                    <a class="dropdown-item" href="<?= base_url('/verPacientes?error=false'); ?>">Ver Pacientes</a>
                                    <a class="dropdown-item" href="<?= base_url('/crearPaciente'); ?>">Crear una nueva Historia Clinica</a>
                                    <a class="dropdown-item" href="<?= base_url('/crearTratamiento'); ?>">Crear un tratamiento</a>
                                    <a class="dropdown-item" href="<?= base_url('/registrarCirujia'); ?>">Registrar una Cirujía</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown" type="button"><a href="#" class="nav-link dropdown-toggle text-white pl-h" data-toggle="dropdown">Inventario</a>
                                <div class="dropdown-menu fade-down">
                                    <a class="dropdown-item" href="<?= base_url('/verInventarios'); ?>">Ver Inventario</a>
                                    <a class="dropdown-item" href="<?= base_url('/actualizarProducto'); ?>">Actualizar cantidades</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown fade-down" type="button"><a href="#" class="nav-link dropdown-toggle text-white pl-h" data-toggle="dropdown">Calendarios y Citas</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="<?= base_url('/verCalendario'); ?>">Ver el calendario</a>
                                    <a class="dropdown-item" href="<?= base_url('/verCitasPorEstado'); ?>">Ver todas las citas</a>
                                </div>
                            </li>

                        </ul>
                        <button class=" ml-auto hidden-button">Always Visible</button>
                        <ul class="navbar-nav text-right">
                            <li class="nav-item mr-5" type="button"><a href="<?= base_url('/logout') ?>" class="btn btn-primary">Cerrar Sesión</a>

                            </li>
                        </ul>
                        <button class="ml-5 hidden-button">Always Visible</button>
                    </div>
                </div>
            </nav>
        <?php endif ?>
    <?php endif ?>
    </header>