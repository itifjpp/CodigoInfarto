<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8" />
        <title>SiGH - <?=$this->sigh->getInfo('hospital_clasificacion')?> <?=$this->sigh->getInfo('hospital_tipo')?> <?=$this->sigh->getInfo('hospital_nombre')?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="Sistema de Gestión Hospitalaria v2.0" name="description" />
        <meta content="bienTICS" name="author" />
        <!-- BEGIN PLUGIN CSS -->
        <link href="<?= base_url()?>assetsv2/plugins/material-iconfont/material-icons.css" rel="stylesheet">
        <!--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
        <?php foreach ($css as $value) {?>
        <link href="<?=base_url()?>assetsv2/<?=$value?>" rel="stylesheet" type="text/css" />
        <?php }?>
        <link href="<?=base_url()?>assetsv2/webarch/css/sigh.css?<?= md5(date('YmdHis'))?>" rel="stylesheet" type="text/css" />
        <link href="<?=  base_url()?>assets/img/<?=$this->sigh->getInfo('hospital_logo')?>" rel="icon" type="image/png">
        <style>
            body{
                background-color: <?=$this->sigh->getInfo('hospital_back_secundary')?>!important; 
            }
            .sigh-color{
                color:<?=$this->sigh->getInfo('hospital_color')?>!important; 
            }
            .sigh-color-primary{
                color:<?=$this->sigh->getInfo('hospital_back_primary')?>!important; 
            }
            .sigh-color-secundary{
                color:<?=$this->sigh->getInfo('hospital_back_secundary')?>!important; 
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
            .sigh-input-icon{
                background-color: <?=$this->sigh->getInfo('hospital_back_secundary')?>!important;
                border:1px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>!important;
                color:white!important;
            }
            .sigh-border{
                border:2px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>!important;
            }
            .table-no-padding td, th{
                padding: 10px!important;
            }
            .table-no-padding th{
                border:1px solid #ddd!important;
                border-color: #E5E9EC !important;
                color: #64696A!important;
                background-color: #E5E9EC!important;
            }
            .table-sigh td, th{
                padding: 10px!important;
            }
            .table-sigh th{
                border:1px solid #256659!important;
                border-color: #256659 !important;
                color: white!important;
                background-color: #256659!important;
            }
        </style>
        <!-- END CORE CSS FRAMEWORK -->
    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <body class="">
        <!-- BEGIN HEADER -->
        <div class="header navbar navbar-inverse " >
            <!-- BEGIN TOP NAVIGATION BAR -->
            <div class="navbar-inner" style="background: #14322D!important">
                <div class="header-seperation transparent sigh-background-secundary">
                    <ul class="nav pull-left notifcation-center visible-xs visible-sm">
                        <li class="dropdown">
                            <a href="#main-menu" data-webarch="toggle-left-side">
                                <i class="material-icons">menu</i>
                            </a>
                        </li>
                    </ul>
                    <!-- BEGIN LOGO -->
                    <a href="#" style="font-size: 20px;color: white;line-height: 1.2">
                        <div style="padding: 10px!important;text-align: center!important;">
                            <h5 class="bold color-white" style="margin-top: 0px"><?=$this->sigh->getInfo('hospital_clasificacion')?>  <?=$this->sigh->getInfo('hospital_tipo')?></h5>
                            <h6 style="margin: 5px 0px;color: white"><?=$this->sigh->getInfo('hospital_nombre')?></h6>
                        </div>
                    </a>
                    <!-- END LOGO -->
                    <ul class="nav pull-right notifcation-center " style="position: absolute;top: 0px;right: 0px;">
                        <li class="dropdown hidden-xs hidden-sm hide">
                            <a href="#" class="dropdown-toggle active" data-toggle="">
                                <i class="material-icons">home</i>
                            </a>
                        </li>
                        <li class="dropdown hidden-xs hidden-sm hide">
                            <a href="#" class="dropdown-toggle">
                                <i class="material-icons">email</i><span class="badge bubble-only"></span>
                            </a>
                        </li>
                        <li class="dropdown visible-xs visible-sm">
                            <a href="<?= base_url()?>config/CerrarSesion">
                                <i class="material-icons">power_settings_new</i>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <div class="header-quick-nav sigh-background-secundary">
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="pull-left">
                        <ul class="nav quick-section hide">
                            <li class="quicklinks">
                                <a href="#" class="" id="layout-condensed-toggle">
                                    <i class="material-icons">menu</i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav quick-section" style="margin-left: 2px">
                            <li class="quicklinks">
                                <h4 class="time color-white" style="font-size: 37px;margin: 0px 0px 0px 0px">
                                    <b class="hora" ><?= date('H')?></b>:<b class="minuto"><?= date('i')?></b>:<b class="segundo"><?= date('s')?></b> 
                                </h4>
                                <h4 style="text-transform: uppercase;font-size: 9px;margin: 2px 0px 0px 0px">
                                <b class="fecha color-white" ></b> 
                                </h4>
                            </li>
                            
                        </ul>
                    </div>
                    <div id="notification-list" style="display:none">
                        <div style="width:300px" class="new-notificacions"></div>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                    <!-- BEGIN CHAT TOGGLER -->
                    <div class="pull-right">
                        <ul class="nav quick-section" >
                            <li class="quicklinks  m-r-10 hide">
                                <a href="#" class="">
                                    <i class="material-icons">refresh</i>
                                </a>
                            </li>
                            <li class="quicklinks">
                                <a href="#" class="new-notificacions-label" id="my-task-list-" data-placement="bottom" data-content='' data-toggle="dropdown" data-original-title="Sin Notificaciones">
                                    <i class="material-icons">notifications_none</i>
                                    <span class="badge badge-success text-center hide" style="bottom: 26px;right: -5px">0</span>
                                </a>
                            </li>
                            <li class="quicklinks"><span class="h-seperate"></span></li>
                            <li class="quicklinks ">
                                <a href="<?= base_url()?>Sections/Chat" class="notifications-msj">
                                    <i class="material-icons">chat</i>
                                    <span class="badge badge-success text-center" style="bottom: 26px;right: -5px">0</span>
                                </a>
                            </li>
                        </ul>
                        <div class="chat-toggler sm">
                            <div class="profile-pic">
                                <img src="<?= base_url()?>assets/img/perfiles/<?=$info['empleado_perfil']?>" alt="" data-src="<?= base_url()?>assets/img/perfiles/<?=$info['empleado_perfil']?>" data-src-retina="<?= base_url()?>assets/img/perfiles/<?=$info['empleado_perfil']?>" width="35" height="35" />
                                <div class="availability-bubble online"></div>
                            </div>
                        </div>
                        <ul class="nav quick-section ">
                            <li class="quicklinks">
                                <a data-toggle="dropdown" class="dropdown-toggle  pull-right " href="#" id="user-options">
                                    <i class="material-icons">apps</i>
                                </a>
                                <ul class="dropdown-menu  pull-right" role="menu" aria-labelledby="user-options">
                                    <li class="" style="background: url('<?= base_url()?>assets/img/background.jpg');background-size: cover;background-position: center">
                                        <div class="center-content">
                                            <img src="<?= base_url()?>assets/img/perfiles/<?=$info['empleado_perfil']?>"  class="" style="border-radius: 50%;width: 70px;height: 70px;margin-top: 10px;border:2px solid white">
                                        </div>
                                        <div style="padding: 5px" class="text-center">
                                            <h6 class="color-white no-margin text-uppercase"><?=$info['empleado_nombre']?> </h6>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="<?= base_url()?>Sections/Usuarios/MiPerfil?v=v2">
                                            <i class="material-icons">person_outline</i>&nbsp; Mi Perfil
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="profile-cambiar-area">
                                            <i class="material-icons" >autorenew</i>&nbsp; Cambiar de área
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="<?= base_url()?>config/CerrarSesion">
                                            <i class="material-icons">power_settings_new</i>&nbsp;&nbsp;Cerrar Sesión
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            
                            
                        </ul>
                    </div>
                    <!-- END CHAT TOGGLER -->
                </div>
            <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END TOP NAVIGATION BAR -->
        </div>
        <!-- END HEADER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container row-fluid">
        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar sigh-background-primary" id="main-menu">
            <!-- BEGIN MINI-PROFILE -->
                <div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrapper">
                    <div class="user-info-wrapper sm">
                        <div class="row no-margin profile-wrapper sm">
                            <style>
                                .sigh-logo-left{
                                    padding: 5px;
                                    width: 100px;
                                    height: 100px;
                                    background: white;
                                    border-radius: 50%;
                                    margin: 0px auto;
                                    position: relative;
                                }
                                .sigh-logo-left img{
                                    margin: 20px auto;
                                    width: 90px;
                                    
                                }
                            </style>
                            <div class="sigh-logo-left">
                                <center>
                                    <img class="" src="<?=  base_url()?>assets/img/<?=$this->sigh->getInfo('hospital_logo')?>" >
                                </center>
                            </div>
                            <div class="" style="padding: 3px;text-align: center">
                                <h5 class="color-white" style="width: 150px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;margin: 5px auto"><?=$info['empleado_nombre']?> <?=$info['empleado_ap']?> <?=$info['empleado_am']?> </h5>
                                <hr class="hr-style-white" style="margin-top: 10px">
                                <h6 class="text-center color-white  line-height" style="width: 150px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;margin: 5px auto"><?=$this->UMAE_AREA?></h6>
                            </div>
                        </div>
                        
                        
                    </div>
                    <!-- END MINI-PROFILE -->
                    <!-- BEGIN SIDEBAR MENU -->
                    
                    <ul class="margin-top-20">
                        <li class="start "> 
                            <a href="<?= base_url()?>Inicio">
                                <i class="material-icons">home</i> 
                                <span class="title">Inicio</span> 
                                <span class="selected"></span>
                            </a>
                        </li>
                        <?=  Modules::run('Menu/loadMenu')?> 
                    </ul>
                    <br>
                    <div class="clearfix"></div>
                    <!-- END SIDEBAR MENU -->
                    <div class="footer-widget sigh-background-secundary">
                        <div class=" transparent progress-small no-radius no-margin text-center">
                            <h6 class="no-margin color-white" style="margin-top: 0px!important;font-size: 12px">SiGH | Sistema de Gestión Hospitalaria</h6>
                            <h6 class="color-white" style="margin-top: 4px!important;font-size: 8px;margin-bottom: -6px">&copy; 2016</h6>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END SIDEBAR -->
            <!-- BEGIN PAGE CONTAINER-->