<?php echo modules::run('Sections/Menu/loadHeader'); ?>
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-8 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white">INDICADORES OBSERVACIÓN</h4>
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
                            <div class="col-md-5 por-turnos hide">
                                <div class="input-group m-b">
                                    <span class="input-group-addon sigh-background-secundary no-border">
                                        <i class="fa fa-clock-o"></i>
                                    </span>
                                    <select class="width100" name="inputTurno">
                                        <option value="Mañana">Mañana</option>
                                        <option value="Tarde">Tarde</option>
                                        <option value="Noche">Noche</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="input-group m-b">
                                    <span class="input-group-addon sigh-background-secundary no-border">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="text" name="inputFechaI" placeholder="Seleccionar Fecha Inicio" value="<?=  date('Y-m-d')?>" class="form-control dp-yyyy-mm-dd">
                                </div>
                            </div>
                            <div class="col-md-5 por-fechas">
                                <div class="input-group m-b">
                                    <span class="input-group-addon sigh-background-secundary no-border">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="text" name="inputFechaF" placeholder="Seleccionar Fecha Termino" value="<?=  date('Y-m-d')?>" class="form-control dp-yyyy-mm-dd">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn sigh-background-secundary btn-block btn-graficas-observacion">Buscar</button>
                            </div>
                        </div>
                        <div class="row">
                            <hr>
                            <div class="col-md-6 col-obs-ingresos text-center text-uppercase ">
                                <a href="#" data-tipo="Observación Ingresos">
                                    <h4>
                                        <span class="loading hide">
                                            <i class="fa fa-spinner fa-pulse sigh-color"></i>
                                        </span>
                                        <b><span class="load">0 Pacientes</span></b>
                                    </h4>
                                    <hr style="margin-top: -3px;margin-bottom: -3px">
                                    <h5>Observación Ingresos</h5>
                                </a>
                            </div>
                            <div class="col-md-6 col-obs-egresos text-center text-uppercase">
                                <a href="#" data-tipo="Observación Egresos">
                                    <h4>
                                        <span class="loading hide">
                                            <i class="fa fa-spinner fa-pulse sigh-color"></i>
                                        </span>
                                        <b><span class="load">0 Pacientes</span></b>
                                    </h4>
                                    <hr style="margin-top: -3px;margin-bottom: -3px">
                                    <h5>Observación Egresos</h5>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 TriageGraficaObservacion"></div>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</div>
<?=modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?=  base_url()?>assets/js/Chart.js" type="text/javascript"></script>
<script src="<?=  base_url()?>assets/js/Urgenciasv2.js?<?= md5(microtime())?>"></script>


