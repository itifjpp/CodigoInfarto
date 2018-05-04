<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-6 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white text-uppercase semi-bold width100">Procedimiento para la clasificación de pacientes</h4>
                        <a href="<?=  base_url()?>Triage/Indicador" class="md-btn md-fab m-b red pull-right tip hide" data-original-title="Indicadores" target="_blank">
                            <i class="fa fa-bar-chart i-24 color-white" ></i>
                        </a>
                    </div>
                    <div class="grid-body">
                        <div class="row" style="margin-top: 0px">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon sigh-background-secundary no-border">
                                        <i class="fa fa-search"></i>
                                    </span>
                                    <input type="number" id="input_search" class="form-control" placeholder="INGRESAR N° DE FOLIO">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="TriageArea" value="<?=$this->UMAE_AREA?>">
<input type="hidden" name="INFO_UM_VALIDARACCEDER" value="<?=INFO_UM_VALIDARACCEDER?>">
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/Medicotriage.js?').md5(microtime())?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/IdleTimer.js?').md5(microtime())?>" type="text/javascript"></script>