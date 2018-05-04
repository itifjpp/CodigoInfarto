<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12">
            <div class="panel panel-default " style="margin-top: -20px">
                <div class="panel-heading p teal-900 back-imss text-center">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase;text-align: center"><b><?=$_SESSION['UMAE_AREA']?></b></span>
                    <a href="<?=  base_url()?>observacion/reportes" target="_blank" md-ink-ripple="" class="md-btn md-fab hidden m-b green waves-effect pull-right tip " data-original-title="Reportes">
                        <i class="fa fa-line-chart fa-2x"></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="" >
                        <div class="row">
                            <style> .cols-camas :nth-child(3n){clear: left!important;}.color-white{color: white!important}</style>
                            <div class="col-md-12" style="padding: 0px;">
                                <div class="result_camas"></div>
                                <h3 class="NO_HAY_CAMAS text-center hidden">HO HAY CAMAS DISPONIBLES PARA ESTA AREA</h3>
                            </div>
                        </div>
                        
                        <input type="hidden" name="accion_rol" value="Choque">
                        <input type="hidden" name="triage_id" value="<?=$_GET['folio']?>">
                        <input type="hidden" name="choque_cama_alta">
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/Choque.js?'). md5(microtime())?>" type="text/javascript"></script>