<?php echo modules::run('Sections/Menu/index'); ?>
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-8 col-centered">
            <div class="panel panel-default " style="margin-top: 10px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">INDICADORES PISOS</span>
                    <a class="md-btn md-fab m-b red pull-left tip" href="<?= base_url()?>Urgencias/Graficas" style="position: absolute;left: -25px;top: 15px">
                        <i class="mdi-navigation-arrow-back i-24" ></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">
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
                                <span class="input-group-addon back-imss border-back-imss">
                                    <i class="fa fa-clock-o"></i>
                                </span>
                                <select class="form-control" name="inputTurno">
                                    <option value="Mañana">Mañana</option>
                                    <option value="Tarde">Tarde</option>
                                    <option value="Noche">Noche</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group m-b">
                                <span class="input-group-addon back-imss border-back-imss">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input type="text" name="inputFechaI" placeholder="Seleccionar Fecha Inicio" value="<?=  date('Y-m-d')?>" class="form-control dp-yyyy-mm-dd">
                            </div>
                        </div>
                        <div class="col-md-5 por-fechas">
                            <div class="input-group m-b">
                                <span class="input-group-addon back-imss border-back-imss">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input type="text" name="inputFechaF" placeholder="Seleccionar Fecha Termino" value="<?=  date('Y-m-d')?>" class="form-control dp-yyyy-mm-dd">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button class="btn back-imss btn-block btn-graficas-pisos">Buscar</button>
                        </div>
                    </div>
                    <div class="row">
                        <hr>
                        <div class="col-md-6 col-pisos-ingresos text-center text-uppercase ">
                            <a href="#">
                                <h4>
                                    <span class="loading hide">
                                        <i class="fa fa-spinner fa-pulse"></i>
                                    </span>
                                    <b><span class="load">0 Pacientes</span></b>
                                </h4>
                                <hr style="margin-top: -3px;margin-bottom: -3px">
                                <h5>Pisos Ingresos</h5>
                            </a>
                        </div>
                        <div class="col-md-6 col-pisos-egresos text-center text-uppercase">
                            <a href="#">
                                <h4>
                                    <span class="loading hide">
                                        <i class="fa fa-spinner fa-pulse"></i>
                                    </span>
                                    <b><span class="load">0 Pacientes</span></b>
                                </h4>
                                <hr style="margin-top: -3px;margin-bottom: -3px">
                                <h5>Pisos Egresos</h5>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 TriageGraficaPisos"></div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
<?=modules::run('Sections/Menu/footer'); ?>
<script src="<?=  base_url()?>assets/js/Chart.js" type="text/javascript"></script>
<script src="<?=  base_url()?>assets/js/Urgenciasv2.js?<?= md5(microtime())?>"></script>


