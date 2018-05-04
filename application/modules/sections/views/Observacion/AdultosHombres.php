<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>UMAE | Dr. Victorio de la Fuente Narváez</title>
        <meta name="description" content="UMAE | Dr. Victorio de la Fuente Narváez" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <link href="<?=  base_url()?>assets/libs/assets/animate.css/animate.css" rel="stylesheet" type="text/css" />
        <link href="<?=  base_url()?>assets/libs/assets/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
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
        <link href="<?=  base_url()?>assets/libs/bootstrap-timepicker/css/bootstrap-timepicker.css" rel="stylesheet" type="text/css" />
        <link href="<?=  base_url()?>assets/libs/bootstrap-colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet" type="text/css" />
        <link href="<?=  base_url()?>assets/libs/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?=  base_url()?>assets/libs/boostrap-clockpicker/bootstrap-clockpicker.min.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?=  base_url()?>assets/libs/html5imageupload/demo.html5imageupload.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?=  base_url()?>assets/libs/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?=  base_url()?>assets/styles/font.css" rel="stylesheet" type="text/css" />
        <link href="<?=  base_url()?>assets/styles/app.css" rel="stylesheet" type="text/css" />
        <link href="<?=  base_url()?>assets/styles/style.css" rel="stylesheet" type="text/css" />
        <link href="<?=  base_url()?>assets/img/imss.png" rel="icon" type="image/png">

    </head>
    <body>
    <div class="app">
        <div class=" bg-big">
            <div class="box-row" style="width: 97%;margin: auto;margin-top: 10px">
                <div class="box-cell">
                    <div class="row" >
                        <div class="col-md-12">
                            <div class="panel panel-default " >
                                <style>
                                    .color-amarillo{ background-color: #FFC107;color: white;}
                                    .color-naranja{background-color: #ff9800;color: white;}
                                </style>
                                <input type="hidden" name="ObservacionTipo" value="AdultosHombres">
                                <div class="panel-body b-b b-light" style="padding-top: 0px">
                                    <div class="row row-loading" style="margin: calc(12.5%)">
                                        <div class="col-md-12">
                                            <center>
                                                <i class="fa fa-spinner fa-pulse fa-4x"></i>
                                            </center>
                                        </div>
                                    </div>
                                    <div class="row row-load hide">
                                        <div class="col-md-12">
                                            <h6 style="margin-top: 5px;margin-bottom: -6px;margin-left: -15px;" >
                                                <span class="fecha-actual"></span>&nbsp;&nbsp; <span class="ultima-actualizacion"></span>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="row row-load hide cols-camas" style="margin-top: 5px;"></div>                          
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>var base_url = "<?= base_url(); ?>"</script>
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
        <script src="<?=  base_url()?>assets/js/bootbox.min.js"></script>
        <script src="<?=  base_url()?>assets/libs/md5.js"></script>
        <script src="<?=  base_url()?>assets/js/jquery.cookie.js"></script>
        <script src="<?=  base_url()?>assets/js/Mensajes.js?<?= md5(microtime())?>" type="text/javascript"></script> 
        <script src="<?=  base_url()?>assets/js/sections/Observacion.js?<?= md5(microtime())?>" type="text/javascript"></script> 
	<script type="text/javascript">var csrf_token = $.cookie('csrf_cookie');</script>

</body>
</html>
