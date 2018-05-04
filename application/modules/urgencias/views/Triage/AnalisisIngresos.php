<?php echo modules::run('Sections/Menu/loadHeaderBasico'); ?>
<div class="row m-t-5">
    <div class="col-md-12">
        <div class="grid simple">
            <div class="grid-title sigh-background-secundary">
                <h4 class="no-margin color-white">ANÁLISIS DE INGRESO DE PACIENTES</h4>
                <button class="btn sigh-background-primary btn-change-date-chart" style="position: absolute;top: 7px;right: 20px">
                    <i class="fa fa-calendar-times-o"></i>
                </button>
            </div>
            <div class="grid-body">
                <div class="row">
                    <div class="col-md-12 col-load-grafica">
                        <h6 class="no-margin text-center"><i class="fa fa-spinner fa-pulse fa-3x"></i></h6>
                        <h4 class="no-margin text-center">Espere por favor...</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="AjaxGraficaAnalisis" value="<?= date('Y-m-d')?>" class="">
<?=modules::run('Sections/Menu/loadFooterBasico'); ?>
<script src="<?=  base_url()?>assets/js/Chart.js" type="text/javascript"></script>
<script src="<?=  base_url()?>assets/js/Urgenciasv2.js?<?= md5(microtime())?>"></script>


