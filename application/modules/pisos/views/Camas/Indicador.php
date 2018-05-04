<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-8 col-centered">
        <div class="box-inner padding">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">INDICADOR DE INGRESOS Y ALTAS EN PISOS</span>
                    
                </div>
                <div class="panel-body b-b b-light">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select class="form-control" name="TipoBusqueda">
                                        <option value="">Seleccionar tipo de busqueda</option>
                                        <option value="POR_FECHA">Por Fechas</option>
                                        <option value="POR_HORA">Por Hora</option>
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row row-por-fecha hide">
                            <div class="col-md-6" style="padding-left: 0px">
                                <div class="input-group m-b">
                                    <span class="input-group-addon back-transparent no-border">DEL</span>
                                    <input type="text" name="by_fecha_inicio" class="form-control dd-mm-yyyy" placeholder="Fecha de inicio">
                                </div>
                            </div>
                            <div class="col-md-6" style="padding-left: 0px">
                                <div class="input-group m-b">
                                    <span class="input-group-addon back-transparent no-border">AL</span>
                                    <input type="text" name="by_fecha_fin" class="form-control dd-mm-yyyy" placeholder="Fecha de fin">
                                </div>
                                <button class="btn btn-primary pull-right btn-indicador-pisos">Buscar</button>
                            </div>
                        </div>
                        <div class="row row-por-hora hide">
                            <div class="col-md-4" style="padding-left: 0px">
                                <div class="input-group m-b">
                                    <span class="input-group-addon back-transparent no-border">DEL</span>
                                    <input type="text" name="by_hora_fecha" class="form-control dd-mm-yyyy " placeholder="Fecha">
                                </div>
                            </div>
                            <div class="col-md-4" style="padding-left: 0px">
                                <div class="input-group m-b">
                                    <span class="input-group-addon back-transparent no-border">DE</span>
                                    <input type="text" name="by_hora_inicio" class="form-control clockpicker" placeholder="Hora de Inicio">
                                </div>
                            </div>
                            <div class="col-md-4" style="padding-left: 0px">
                                <div class="input-group m-b" >
                                    <span class="input-group-addon back-transparent no-border">A</span>
                                    <input type="text" name="by_hora_fin" class="form-control clockpicker" placeholder="Hora de Fin">
                                </div>
                                <button class="btn btn-primary pull-right btn-indicador-pisos">Buscar</button>
                            </div>
                        </div>
                        <div class="row">
                            <a href="#" class="total-ingresos">
                                <div class="col-md-6 text-center " >
                                    <h3>0 Pacientes</h3>
                                    <h5>INGRESOS</h5>
                                </div>
                            </a>
                            <a href="" class="total-altas">
                                <div class="col-md-6 text-center " style="border-left: 2px solid #256659">
                                    <h3>0 Pacientes</h3>
                                    <h5>ALTAS</h5>
                                </div>
                            </a>
                        </div>
                        <hr>
                        <input type="hidden" name="triage_tipo" value="Enfermeria">
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/Pisos.js?').md5(microtime())?>" type="text/javascript"></script>