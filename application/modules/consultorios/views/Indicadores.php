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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="form-control" name="TIPO_BUSQUEDA">
                                        <option value="POR_FECHA">REALIZAR BUSQUEDA POR FECHAS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4" style="padding: 0px">
                                <div class="form-group">
                                    <input type="text" name="inputFechaInicio" value="<?= date('Y-m-d')?>" class="form-control dp-yyyy-mm-dd" placeholder="Seleccionar Fecha">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button class="btn sigh-background-primary btn-block btn-indicador-ce">Buscar</button>
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-md-12">
                                <div class="panel panel-default ">
                                    <div class="panel-body b-b b-light text-center">
                                        <br>
                                        <h4 class="TOTAL_PACIENTES_CONSULTORIOS_DOC mayus-bold" >DOCUMENTOS GENERADOS: <span>0 Pacientes</span></h4>
                                        
                                        <a href="#" class="GENERAR_LECHAGA_CONSULTORIOS hide">
                                            <button class="btn sigh-background-primary ">Generar Lechuga</button>
                                        </a>
                                    </div>
                                </div>
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

