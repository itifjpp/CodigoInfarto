<?php echo modules::run('Sections/Menu/loadHeader'); ?>
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-10 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white">INDICADORES TRIAGE</h4>
                        <a class="md-btn md-fab m-b red pull-left tip" href="<?= base_url()?>Urgencias/Graficas" style="position: absolute;left: -25px;top: 15px">
                            <i class="material-icons color-white i-24">arrow_back</i>
                        </a>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="md-check text-uppercase">
                                    <input type="radio" name="inputFiltro" value="Fechas" checked="">
                                    <i class="blue"></i>Busqueda por Rango de Fechas
                                </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <label class="md-check text-uppercase">
                                    <input type="radio" name="inputFiltro" value="Turnos">
                                    <i class="blue"></i>Busqueda Turnos
                                </label>
                            </div>
                            
                        </div>
                        <hr style="margin-top: 10px">
                        <div class="row" style="margin-top: -10px">
                            <div class="col-md-3 por-turnos hide">
                                <div class="input-group m-b">
                                    <span class="input-group-addon no-border sigh-background-primary">
                                        <i class="fa fa-clock-o"></i>
                                    </span>
                                    <select class="width100" name="inputTurno">
                                        <option value="Mañana">Mañana</option>
                                        <option value="Tarde">Tarde</option>
                                        <option value="Noche">Noche</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group m-b">
                                    <span class="input-group-addon no-border sigh-background-primary">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="text" name="inputFechaI" placeholder="Seleccionar Fecha Inicio" value="<?=  date('Y-m-d')?>" class="form-control dp-yyyy-mm-dd">
                                </div>
                            </div>
                            <div class="col-md-3 por-fechas">
                                <div class="input-group m-b">
                                    <span class="input-group-addon no-border sigh-background-primary">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="text" name="inputFechaF" placeholder="Seleccionar Fecha Termino" value="<?=  date('Y-m-d')?>" class="form-control dp-yyyy-mm-dd">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn sigh-background-primary btn-block btn-graficas-triage">Buscar</button>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary btnExportChartToPDF hide btn-block" >
                                    <i class="fa fa-file-pdf-o"></i> PDF
                                </button>
                            </div>
                            <div class="col-md-2">
                                
                                <button class="btn btn-primary btn-block btn-indicador-triage-download hide" type="button">
                                    <i class="fa fa-cloud-download"></i> EXCEL
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <hr>
                            <div class="col-md-3 col-horacero text-center text-uppercase">
                                <a href="#" class="tip" data-tipo="Hora Cero">
                                    <h4>
                                        <span class="loading hide">
                                            <i class="fa fa-spinner fa-pulse"></i>
                                        </span>
                                        <b><span class="load">0 Pacientes</span></b>
                                    </h4>
                                    <hr style="margin-top: -3px;margin-bottom: -3px">
                                    <h5>Hora Cero</h5>
                                </a>
                            </div>
                            <div class="col-md-3 col-triage-enfermeria text-center text-uppercase" style="border-left: 2px solid <?=$this->sigh->getInfo('hospital_back_primary')?>">
                                <a href="#" class="tip" data-tipo="Triage Enfermería" >
                                    <h4>
                                        <span class="loading hide">
                                            <i class="fa fa-spinner fa-pulse"></i>
                                        </span>
                                        <b><span class="load">0 Pacientes</span></b>
                                    </h4>
                                    <hr style="margin-top: -3px;margin-bottom: -3px">
                                    <h5 >Triage Enfermería</h5>
                                </a>
                            </div>
                            <div class="col-md-3 col-triage-medico text-center text-uppercase" style="border-left: 2px solid <?=$this->sigh->getInfo('hospital_back_primary')?>">
                                <a href="#" class="tip" data-tipo="Triage Médico" >
                                    <h4>
                                        <span class="loading hide">
                                            <i class="fa fa-spinner fa-pulse"></i>
                                        </span>
                                        <b><span class="load">0 Pacientes</span></b>
                                    </h4>
                                    <hr style="margin-top: -3px;margin-bottom: -3px">
                                    <h5 >Triage Médico</h5>
                                </a>
                            </div>
                            <div class="col-md-3 col-asistente-medica text-center text-uppercase" style="border-left: 2px solid <?=$this->sigh->getInfo('hospital_back_primary')?>">
                                <a href="#" class="tip" data-tipo="Asistente Médica" >
                                    <h4>
                                        <span class="loading hide">
                                            <i class="fa fa-spinner fa-pulse"></i>
                                        </span>
                                        <b><span class="load">0 Pacientes</span></b>
                                    </h4>
                                    <hr style="margin-top: -3px;margin-bottom: -3px">
                                    <h5 >Asistente Médica</h5>
                                </a>
                            </div>
                            
                            <div class="col-md-6 col-total-derechohabientes">
                                <h4 class="text-center">
                                    <span class="loading hide">
                                        <i class="fa fa-spinner fa-pulse"></i>
                                    </span>
                                    <b><span class="load">0 PACIENTES</span></b>
                                </h4>
                                <hr style="margin-top: -3px;margin-bottom: -3px">
                                <h5 class="text-center">DERECHOHABIENTES</h5>
                            </div>
                            <div class="col-md-6 col-total-noderechohabientes">
                                <h4 class="text-center">
                                    <span class="loading hide">
                                        <i class="fa fa-spinner fa-pulse"></i>
                                    </span>
                                    <b><span class="load">0 PACIENTES</span></b>
                                </h4>
                                <hr style="margin-top: -3px;margin-bottom: -3px">
                                <h5 class="text-center">NO DERECHOHABIENTES</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-grafica-clasificacion hide">
                                <hr>
                                <div >
                                    <center>
                                        <i class="fa fa-spinner fa-pulse fa-3x sigh-color"></i>
                                        <h5>Obteniendo Grafica de Clasificación</h5>
                                    </center>

                                </div>
                            </div>
                            <div class="col-md-12 GraficaIndicadorTriage">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-graficas-tipos-triage hide">
                                <hr>
                                <center>
                                    <i class="fa fa-spinner fa-pulse fa-3x"></i>
                                    <h5>Obteniendo Grafica de Pacientes Referidos & Espontáneos</h5>
                                </center>
                            </div>
                        </div>
                        <div class="row row-graficas-espontaneo-referido"></div>
                       
                    </div>
                </div>    
            </div>
        </div>
    </div>
</div>
<?=modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?=  base_url()?>assets/js/Chart.js" type="text/javascript"></script>
<script src="<?=  base_url()?>assets/js/Urgenciasv2.js?<?= md5(microtime())?>"></script>

