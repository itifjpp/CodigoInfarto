<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-8 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin semi-bold color-white">INDICADORES DE PRODUCTIVIDAD</h4>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon sigh-background-primary no-border">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control dp-yyyy-mm-dd" name="inputDateStart" placeholder="FECHA DE INICIO">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon sigh-background-primary no-border">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control dp-yyyy-mm-dd" name="inputDateEnd" placeholder="FECHA DE TERMINO">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-groups">
                                    <button class="btn sigh-background-primary btn-block btn-indicador-ce-personal">Buscar</button>
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-xs-12">
                            <div class="col-xs-8 m-t-10">
                                <h2 class="text-center no-margin ce-total-ingresados">0</h2>
                                <h3 class="text-center semi-bold no-margin">TOTAL DE PACIENTES ATENDIDOS</h3>
                            </div>
                            <div class="col-xs-4">
                                <button class="btn sigh-background-primary text-center btn-block btn-ce-reporte-productividad">
                                    <i class="fa fa-cloud-download fa-3x"></i>
                                    <h5 class="color-white no-margin">Generar Reporte</h5>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="empleado_id" value="<?=$this->UMAE_USER?>">
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?=  base_url()?>assets/js/Chart.js" type="text/javascript"></script>
<script src="<?= base_url('assets/js/Consultorios.js?'). md5(microtime())?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/IdleTimer.js?').md5(microtime())?>" type="text/javascript"></script>

