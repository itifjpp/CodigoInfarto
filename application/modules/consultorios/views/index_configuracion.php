<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-xs-8 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white text-uppercase semi-bold width100">CONFIGURACIÓN GENERAL CONSULTORIOS</h4>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>">
                                    <h5 class="m-b-5 m-t-5 semi-bold">CONFIGURACIÓN TURNOS DE LLAMADA EN LA LISTA DE ESPERA</h5>
                                </div>
                            </div>
                            <?php 
                                $sqlConfigListaEspera=$this->config_mdl->sqlGetDataCondition('sigh_consultorios_le_llamados',array(
                                    'llamado_id'=>2
                                ))[0];
                            ?>
                            <div class="col-xs-3">
                                <div class="input-group">
                                    <span class="input-group-addon bg-yellow no-border color-white">
                                        <i class="fa fa-clock-o"></i>
                                    </span>
                                    <input type="number" name="llamado_espera_amarillo" min="1" max="7" class="form-control" value="<?=$sqlConfigListaEspera['llamado_espera_amarillo']?>">
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="input-group">
                                    <span class="input-group-addon bg-green no-border color-white">
                                        <i class="fa fa-clock-o"></i>
                                    </span>
                                    <input type="number" name="llamado_espera_verde" min="1" max="7" class="form-control" value="<?=$sqlConfigListaEspera['llamado_espera_verde']?>">
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="input-group">
                                    <span class="input-group-addon bg-blue no-border color-white">
                                        <i class="fa fa-clock-o"></i>
                                    </span>
                                    <input type="number" name="llamado_espera_azul" min="1" max="7" class="form-control" value="<?=$sqlConfigListaEspera['llamado_espera_azul']?>">
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <button class="btn sigh-background-primary btn-block btn-save-config-le">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= Modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url()?>assets/js/sections/Configuracion.js?<?= date('YmdHis')?>" type="text/javascript"></script>