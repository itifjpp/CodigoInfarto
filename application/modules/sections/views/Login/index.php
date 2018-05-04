<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>SiGH | Iniciar Sesión</title>
        <meta http-equiv="Cache-Control" content="no-store" />
        <meta http-equiv="Cache-Control" content="no-cache" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="expires" content="Fri, 18 Jul 2014 1:00:00 GMT" />
        <meta name="description" content="SiGH | Iniciar Sesión" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <link rel="stylesheet" href="<?=  base_url()?>assets/libs/assets/animate.css/animate.css" type="text/css" />
        <link rel="stylesheet" href="<?=  base_url()?>assets/libs/assets/font-awesome/css/font-awesome.css" type="text/css" />
        <link rel="stylesheet" href="<?=  base_url()?>assets/libs/jquery/waves/dist/waves.css" type="text/css" />
        <link rel="stylesheet" href="<?=  base_url()?>assets/styles/material-design-icons.css" type="text/css" />
        <link href="<?=  base_url()?>assets/libs/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?=  base_url()?>assets/img/imss.png" rel="icon" type="image/png">
        <link href="<?=  base_url()?>assets/libs/jquery/bootstrap/dist/css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="<?=  base_url()?>assets/styles/font.css" rel="stylesheet" type="text/css" />
        <link href="<?=  base_url()?>assets/styles/app.css" rel="stylesheet" type="text/css" />
        <link href="<?=  base_url()?>assets/styles/style.css?<?= md5(microtime())?>" rel="stylesheet" type="text/css" />
        
        <link href="<?=  base_url()?>assets/libs/jquery-notifications/css/messenger.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?=  base_url()?>assets/libs/jquery-notifications/css/messenger-theme-flat.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?=  base_url()?>assets/libs/jquery-notifications/css/location-sel.css" rel="stylesheet" type="text/css" media="screen"/>
    </head>
    <body>
        <div class="app">
            <div class="center-block w-xxl w-auto-xs p-v-md">
                <div class="navbar">
                    <div class=" m-t-lg text-center">
                        <img src="<?=  base_url()?>assets/img/imss.png" style="width: 30%">
                    </div>
                </div>
                <div class="p-lg panel md-whiteframe-z1 text-color m" style="border-left: 4px solid #256659;padding-left: 20px;padding-right: 20px">
                    
                    <form name="form" class="login-form row-login">
                        <div class="form-group">
                            <label><b>SELECCIONAR ÁREA</b></label>
                            <select class="select2 width100" name="empleado_area" id="empleado_area">
                                <option value=""></option>
                                <?php foreach ($Gestion as $value){?>
                                <option value="<?=$value['areas_acceso_nombre']?>"><?=$value['areas_acceso_nombre']?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="form-group content-show-pass">
                            <label><b>MATRICULA</b></label>
                            <input type="password" name="empleado_matricula" autocomplete="off"  class="form-control" placeholder="Matricula" required>
                            <i class="fa fa-unlock icono-accion show-hide-matricula pointer tip" data-original-title="Mostrar / Ocultar Matricula"> </i>
                        </div>
                        <div class="m-b-md">        
                            <label class="md-check">
                                <input type="checkbox"><i class="back-imss"></i> <b>RECORDARME</b>
                            </label>
                        </div>
                        <button md-ink-ripple type="submit" class="btn back-imss btn-block">Accesar</button>
                    </form>
                </div>
                
            </div>
        </div>
        <script src="<?=  base_url()?>assets/libs/jquery/jquery/dist/jquery.js"></script>
        <script>var base_url='<?=  base_url()?>';</script>
        <script src="<?=  base_url()?>assets/libs/jquery/jquery/dist/jquery.js"></script>
        <script src="<?=  base_url()?>assets/libs/jquery/bootstrap/dist/js/bootstrap.js"></script>
        <script src="<?=  base_url()?>assets/libs/jquery/waves/dist/waves.js"></script>
        <script src="<?=  base_url()?>assets/scripts/ui-load.js"></script>
        <script src="<?=  base_url()?>assets/scripts/ui-jp.config.js"></script>
        <script src="<?=  base_url()?>assets/scripts/ui-jp.js"></script>
        <script src="<?=  base_url()?>assets/scripts/ui-nav.js"></script>
        <script src="<?=  base_url()?>assets/scripts/ui-toggle.js"></script>
        <script src="<?=  base_url()?>assets/scripts/ui-form.js"></script>
        <script src="<?=  base_url()?>assets/scripts/ui-waves.js"></script>
        <script src="<?=  base_url()?>assets/scripts/ui-client.js"></script>
        <script src="<?=  base_url()?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="<?=  base_url()?>assets/libs/bootstrap-fileinput/js/fileinput.js"></script>
        <script src="<?=  base_url()?>assets/libs/bootstrap-fileinput/js/fileinput_locale_es.js"></script>
        <script src="<?=  base_url()?>assets/libs/pace/pace.min.js" type="text/javascript"></script>
        <script src="<?=  base_url()?>assets/libs/underscore-min.js" type="text/javascript"></script>
        <script src="<?=  base_url()?>assets/libs/backbone-min.js" type="text/javascript"></script>
        <script src="<?=  base_url()?>assets/libs/jquery-notifications/js/demo/demo.js" type="text/javascript" ></script>
        <script src="<?=  base_url()?>assets/libs/jquery-inputmask/jquery.inputmask.min.js" type="text/javascript"></script>
        <script src="<?=  base_url()?>assets/libs/jquery-autonumeric/autoNumeric.js" type="text/javascript"></script>
        <script src="<?=  base_url()?>assets/libs/jquery-notifications/js/messenger.min.js" type="text/javascript"></script>
        <script src="<?=  base_url()?>assets/libs/jquery-notifications/js/messenger-theme-future.js" type="text/javascript"></script>	
        <script src="<?=  base_url()?>assets/libs/jquery-notifications/js/demo/location-sel.js" type="text/javascript" ></script>
        <script src="<?=  base_url()?>assets/libs/jquery-notifications/js/demo/theme-sel.js" type="text/javascript" ></script>
        <script src="<?=  base_url()?>assets/libs/html5imageupload/html5imageupload.js" type="text/javascript"></script>
        <script src="<?=  base_url()?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
        <script src="<?=  base_url()?>assets/libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <script src="<?=  base_url()?>assets/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.js" type="text/javascript"></script>
        <script src="<?=  base_url()?>assets/libs/jquery-inputmask/jquery.inputmask.min.js" type="text/javascript"></script>
        <script src="<?=  base_url()?>assets/libs/bootstrap-tag/bootstrap-tagsinput.min.js" type="text/javascript"></script>
        <script src="<?=  base_url()?>assets/libs/boostrap-clockpicker/bootstrap-clockpicker.min.js" type="text/javascript"></script>
        <script src="<?=  base_url()?>assets/libs/bootstrap-select2/select2.min.js"></script>
        <script src="<?=  base_url()?>assets/libs/bootstrap-datepicker/js/locales/bootstrap-datepicker.es.js"></script>
        <script src="<?=  base_url()?>assets/libs/footable/footable.all.min.js"></script>
        <script src="<?=  base_url()?>assets/libs/jquery-validation/js/jquery.validate.min.js"></script>
        <script src="<?=  base_url()?>assets/libs/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
        <script src="<?=  base_url()?>assets/libs/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
        <script src="<?=  base_url()?>assets/js/bootbox.min.js"></script>
        <script src="<?=  base_url()?>assets/libs/moment.js" type="text/javascript"></script>
        <script src="<?=  base_url()?>assets/libs/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js" type="text/javascript"></script>
        <script src="<?=  base_url()?>assets/libs/md5.js"></script>
        <script src="<?=  base_url()?>assets/js/jquery.cookie.js"></script>
        <script src="<?=  base_url()?>assets/js/Mensajes.js?<?= md5(microtime())?>"></script>
        <script src="<?=  base_url()?>assets/js/sections/login.js?<?= md5(microtime())?>"></script>
    </body>
</html>
