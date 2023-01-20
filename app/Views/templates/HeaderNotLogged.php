<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$TituloPagina?></title>
    <link rel="stylesheet" href="<?=base_url('/css/bootstrap.min.css');?>" />
    <link rel="stylesheet" href="<?=base_url('/css/site.css');?>"/>
    <link rel="stylesheet" href="<?=base_url('/css/jquery-ui.min.css');?>" />
    <link rel="stylesheet" href="<?=base_url('/css/select2.min.css');?>" />
    <script src="<?=base_url('/js/jquery-3.5.1.min.js');?>"></script>
    <script src="<?=base_url('/js/jquery-ui.min.js');?>"></script>
    <script src="<?=base_url('/js/bootstrap.bundle.min.js');?>"></script>
    <script src="<?=base_url('/js/Site.js');?>"></script>
    <script src="<?=base_url('/js/select2.min.js');?>"></script>
</head>
<body>
<header>
        <nav class="navbar navbar-expand-md navbar-dark scrolling navbar pt-3">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">DentalControl</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#NavbarDarkDropdown">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <button class=" ml-auto hidden-button">Always Visible</button>
                    <ul class="navbar-nav text-right">
                        <li class="nav-item mr-5" type="button" ><a href="<?=base_url('/loginIndex')?>" class="btn btn-primary" >Iniciar Sesión</a>
                            
                        </li>
                    </ul>
                <button class="ml-5 hidden-button">Always Visible</button>
            </div>
        </nav>
    </header>