<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="color-white no-margin text-uppercase semi-bold"><?=$_SESSION['UMAE_AREA']?></h4>
                        <div style="position: relative;margin-top: 0px">
                            <a href="#" class="md-btn md-fab m-b red eliminar-paciente-pisos pull-right tip " data-placement="bottom"  style="margin-top: -40px;right: 110px;position: absolute">
                                <i class="fa fa-user-times i-24 color-white"></i>
                            </a>
                            <a href="#" class="md-btn md-fab m-b red actualizar-camas-pisos pull-right tip " data-placement="bottom" data-original-title="Actualizar vista de camas" style="margin-top: -40px;right: 50px;position: absolute">
                                <i class="fa fa-refresh i-24 color-white"></i>
                            </a>
                            <a href="#" onclick="AbrirVista(base_url+'Pisos/Enfermeria/Indicador')" class="md-btn md-fab m-b red pull-right tip" data-placement="bottom" data-original-title="Reporte de Estados de Camas" style="margin-top: -40px;right: -10px;;position: absolute">
                                <i class="fa fa-cloud-download i-24 color-white"></i>
                            </a>    
                        </div>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <style> .cols-camas :nth-child(3n){clear: left!important;}.color-white{color: white!important}</style>
                            <div class="col-md-12" style="margin-top: 10px">
                                <div class="result_camas row"></div>
                                <h3 class="NO_HAY_CAMAS text-center hidden">HO HAY CAMAS DISPONIBLES PARA ESTA AREA</h3>
                            </div>
                        </div>
                        <input type="hidden" name="accion_rol" value="Choque">
                        <input type="hidden" name="ingreso_id" value="<?=$_GET['folio']?>">
                        <input type="hidden" name="ap_alta">
                        <input type="hidden" name="RealizarAjax" value="Si"> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/PisosEnfermeria.js?').md5(microtime())?>" type="text/javascript"></script>