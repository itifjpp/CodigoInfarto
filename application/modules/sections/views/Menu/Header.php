<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title style="text-transform: uppercase">SiGH | <?=$this->sigh->getInfo('hospital_tipo')?> <?=$this->sigh->getInfo('hospital_nombre')?></title>
        <meta http-equiv="Cache-control" content="no-cache">
        <meta http-equiv='expires' content='0'>
        <meta http-equiv='pragma' content='no-cache'>
        <meta name="description" content="SiGH | <?=$this->sigh->getInfo('hospital_tipo')?> <?=$this->sigh->getInfo('hospital_nombre')?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <link href="<?=  base_url()?>assets/libs/assets/animate.css/animate.css" rel="stylesheet" type="text/css" />
        <link href="<?=  base_url()?>assets/libs/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
        <link href="<?=  base_url()?>assets/libs/jquery/waves/dist/waves.css" rel="stylesheet" type="text/css" />
        <link href="<?=  base_url()?>assets/styles/material-design-icons.css" rel="stylesheet" type="text/css" />
        <link href="<?=  base_url()?>assets/libs/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?=  base_url()?>assets/libs/bootstrap-datepicker/css/datepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=  base_url()?>assets/libs/jquery/bootstrap/dist/css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="<?=  base_url()?>assets/libs/bootstrap-fileinput/css/fileinput.css" rel="stylesheet" type="text/css" />
        <link href="<?=  base_url()?>assets/libs/jquery-notifications/css/messenger.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?=  base_url()?>assets/libs/jquery-notifications/css/messenger-theme-flat.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?=  base_url()?>assets/libs/jquery-notifications/css/location-sel.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?=  base_url()?>assets/libs/bootstrap-tag/bootstrap-tagsinput.css" rel="stylesheet" type="text/css"/>
        <link href="<?=  base_url()?>assets/libs/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" type="text/css" />
        <link href="<?=  base_url()?>assets/libs/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css" />
        <link href="<?=  base_url()?>assets/libs/bootstrap-timepicker/css/bootstrap-timepicker.css" rel="stylesheet" type="text/css" />
        <link href="<?=  base_url()?>assets/libs/bootstrap-colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet" type="text/css" />
        <link href="<?=  base_url()?>assets/libs/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?=  base_url()?>assets/libs/boostrap-clockpicker/bootstrap-clockpicker.min.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?=  base_url()?>assets/libs/html5imageupload/demo.html5imageupload.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?=  base_url()?>assets/libs/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css" rel="stylesheet">
        <link href="<?=  base_url()?>assets/styles/font.css" rel="stylesheet" type="text/css" />
        <link href="<?=  base_url()?>assets/styles/app.css?time=<?= sha1(microtime())?>" rel="stylesheet" type="text/css" />
        <link href="<?=  base_url()?>assets/styles/style.css?time=<?= sha1(microtime())?>" rel="stylesheet" type="text/css" />
        <link href="<?=  base_url()?>assets/img/<?=$this->sigh->getInfo('hospital_logo_login')?>" rel="icon" type="image/png">
        <style>
            .sigh-color{
                color:<?=$this->sigh->getInfo('hospital_color')?>!important; 
            }
            .sigh-background-primary{
                color:white!important;
                background: <?=$this->sigh->getInfo('hospital_back_primary')?>!important; 
            }
            .sigh-background-secundary{
                background: <?=$this->sigh->getInfo('hospital_back_secundary')?>!important; 
                color:white!important;
            }
            .modal-header{
                color: white!important;
                background: <?=$this->sigh->getInfo('hospital_back_secundary')?>!important;
                border-radius: 8px 8px 0px 0px;
            }
            
        </style>
    </head>
    <body>
        <div class="app">
            <aside id="aside" class="app-aside modal  " role="menu">
                <div class="left ">
                    <div class="box sigh-background-primary">
                        <style> nav ul.nav li a > .icon:before, nav ul.nav li .nav-item > .icon:before {opacity: 1!important;}</style>
                        <div class="navbar md-whiteframe-z1 waves-effect no-radius text-center  sigh-background-secundary"  style="padding:11.5px;width: 100%;<?=$BoxShadow?>">
                            <span class="h2 text-nowrap-imss" style="font-weight: bold;font-size: 18px;"><?=$this->sigh->getInfo('hospital_tipo')?></span>
                            <br>
                            <span class="h2 text-nowrap-imss" style="font-size: 12px;"><?=$this->sigh->getInfo('hospital_nombre')?> </span>
                        </div>
                        
                        <div class="box-row">
                            <div class="box-cell scrollable ">
                                <div class="box-inner ">
                                    <div class="p hidden-folded blue-50 text-center sigh-background-primary" >
                                        <div class="rounded bg-white inline pos-rlt" style="width: 124px;height: 124px">
                                            <center>
                                            <img src="<?=  base_url()?>assets/img/<?=$this->sigh->getInfo('hospital_logo')?>" class="img-responsive " style="background-size: cover;width: 80px;height: 95px; margin-top: 15px;background-size: cover">
                                            </center>
                                        </div>
                                        <a class="block m-t-sm" target="#nav, #account">
                                            <span class="block font-bold" style="font-size: 15px;text-transform: uppercase">
                                                <?=$info['empleado_nombre']?> <?=$info['empleado_apellidos']?>
                                            </span>
                                            <hr class="hr-style1" style="margin-top: 3px;margin-bottom: 3px;">
                                            <p>
                                                <b style="text-transform: uppercase"><?=$this->UMAE_AREA?></b>
                                            </p>
                                        </a>
                                    </div>
                                    <div id="nav">
                                        <nav ui-nav>
                                            <ul class="nav">
                                                <li>
                                                    <a md-ink-ripple href="<?=  base_url()?>inicio">
                                                        <i class="icon fa fa-home i-20"></i>
                                                        <span class="font-normal color-white" style="margin-left: -15px;">Inicio</span>
                                                    </a>
                                                </li>
                                                <?=  Modules::run('menu/ObtenerMenu')?> 
                                                <br><br>
                                            </ul>
                                        </nav>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <nav>
                            <ul class="nav b-t b back-imss-all hide">
                                <li>
                                    <a href="#"  md-ink-ripple>
                                        <input type="hidden" name="csrf_token">
                                        <span> Sitio desarrollado por bienTICS </span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </aside>
            <div id="content" class="app-content" role="main">
                <div class="box">
                    <div class="navbar md-whiteframe-z1 no-radius sigh-background-secundary" >
                        <a md-ink-ripple  data-toggle="modal" data-target="#aside" class="navbar-item pull-left visible-xs visible-sm"><i class="mdi-navigation-menu i-24"></i></a>
                        <ul class="nav nav-sm navbar-tool pull-left" style="padding-left: 5px;">
                            <li>
                                <p class="time" style="font-size: 37px;margin: 0px 0px 0px 0px">
                                    <b class="hora" ><?= date('H')?></b>:<b class="minuto"><?= date('i')?></b>:<b class="segundo"><?= date('s')?></b> 
                                </p>
                                <p style="text-transform: uppercase;font-size: 9px;margin: -5px 0px 0px 0px">
                                <b class="fecha" ></b> 
                                </p>
                            </li>
                            <li class=""> 
                                
                            </li>
                        </ul>
                        <ul class="nav nav-sm navbar-tool pull-right">
                            <li class="notifications-msj" style="margin-right: -12px">
                                <a href="#">
                                    <i class="fa fa fa-comments-o i-24"></i>
                                    <span class="badge bg-danger up">0</span>
                                </a>
                            </li>
                            <li class="notifications-msj ">
                                <a href="#">
                                    <i class="fa fa-bell-o i-24" ></i>
                                    <b class="badge bg-danger up" >0</b>
                                </a>
                            </li>
                            <li>
                                <div style="width: 30px;height: 30px;margin-top: 16px;border-radius: 100px!important">
                                    <a href="#">
                                    <img src="<?=  base_url()?>assets/img/perfiles/<?=$info['empleado_perfil']?>" style="width: 30px;height: 30px;">
                                    </a>
                                </div>
                            </li>
                            
                            <li class="dropdown">
                                <a md-ink-ripple data-toggle="dropdown">
                                    <i class="mdi-navigation-more-vert i-24"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-scale pull-right pull-up text-color" style="padding-bottom: 0px!important">
                                    <li>
                                        <div style="background: url(<?= base_url()?>assets/img/perfiles/background.jpg);width: 100%;height: 100px;margin-top: -5px;background-size: cover"></div>
                                        <div style="position: absolute;left: 40px;margin-top: -92px;background: white;padding: 2px; width: 90px;border-radius: 50%;">
                                            <center>
                                                <img src="<?=  base_url()?>assets/img/perfiles/<?=$info['empleado_perfil']?>" style="width: 86px;height: 83px;border-radius: 50%">
                                            </center>
                                        </div>
                                    </li>
                                    <li class="" style="margin: 0px!important;">
                                        <a href="<?= base_url()?>Sections/Usuarios/MiPerfil">
                                            <i class="mdi-social-person i-24"></i>&nbsp;&nbsp;Mi Perfil
                                        </a>
                                    </li>
                                    <li class="divider" style="margin: 0px!important;"></li>
                                    <li style="margin: 0px!important;">
                                        <a href="<?=  base_url()?>config/CerrarSesion">
                                            <i class="mdi-action-settings-power i-24"></i>&nbsp;&nbsp;Cerrar sesión
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    