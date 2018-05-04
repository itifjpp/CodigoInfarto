<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-8 col-centered">
            <div class="panel panel-default " style="margin-top: 10px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase;">
                        <b>INDICADOR DE CAMAS PISOS</b>
                    </span>
                    <a href="#"  md-ink-ripple="" data-accion="add" data-sala="" data-id="0" class="md-btn btn-indicador-pisos-doc hide md-fab m-b red waves-effect pull-right" style="position: absolute;right: 10px;top: 10px">
                        <i class="fa fa-cloud-download i-24"></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row" >
                        <div class="col-md-5">
                            <div class="input-group m-b">
                                <span class="input-group-addon back-imss border-back-imss">
                                    <i class="fa fa-clock-o "></i>
                                </span>
                                <select name="inputTurno" class="form-control">
                                    <option value="">Seleccionar Turno</option>
                                    <option value="Mañana">Mañana</option>
                                    <option value="Tarde">Tarde</option>
                                    <option value="Noche">Noche</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group m-b">
                                <span class="input-group-addon back-imss border-back-imss">
                                    <i class="fa fa-calendar-o "></i>
                                </span>
                                <input type="text" name="inputFecha" class="form-control dp-yyyy-mm-dd">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button class="btn back-imss btn-block btn-pisos-indicador-ie">BUSCAR</button>
                        </div>
                    </div>
                    <div class="row">
                        <hr>
                        <div class="col-md-6 text-center col-pisos-ingresos">
                            <a href="#">
                                <h3 class="mayus-bold">0 PACIENTES</h3>
                                <h5>INGRESOS PISOS</h5>
                            </a>
                            
                        </div>
                        <div class="col-md-6 text-center col-pisos-egresos" style="border-left: 2px solid #256659">
                            <a href="#">
                                <h3 class="mayus-bold">0 PACIENTES</h3>
                                <h5>EGRESOS PISOS</h5>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url()?>assets/js/PisosEnfermeria.js?<?=md5(microtime())?>" type="text/javascript"></script>
