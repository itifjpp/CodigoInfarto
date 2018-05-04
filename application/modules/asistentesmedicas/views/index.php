<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-6 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white text-uppercase semi-bold width100">SOLICITUD DE PACIENTES TRIAGE</h4>
                        <a href="<?=  base_url()?>Asistentesmedicas/Indicadores" md-ink-ripple="" class="md-btn hide md-fab m-b red pull-right tip " style="position: absolute;right: 0px;top: 0px">
                            <i class="fa fa-bar-chart i-24 color-white"></i>
                        </a>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon sigh-background-secundary no-border">
                                        <i class="fa fa-search"></i>
                                    </span>
                                    <input type="number" name="ingreso_id" class="form-control" placeholder="INGRESAR N° DE FOLIO">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
<?= modules::run('Sections/Menu/loadFooter'); ?> 
<input type="hidden" name="INFO_UM_VALIDARACCEDER" value="<?=INFO_UM_VALIDARACCEDER?>">
<input type="hidden" name="empleado_id" value="<?=$this->UMAE_USER?>">
<input type="hidden" value="Asistente Médica" name="AsistenteMedicaTipo">
<input type="hidden" name="TableAjaxAmd" value="Si">
<input type="hidden" name="CONFIG_AM_HOJAINICIAL" value="<?=CONFIG_AM_HOJAINICIAL?>">
<script src="<?= base_url('assets/js/Asistentemedica.js?'). md5(microtime())?>" type="text/javascript"></script> 
<script src="<?= base_url('assets/js/IdleTimer.js?').md5(microtime())?>" type="text/javascript"></script>