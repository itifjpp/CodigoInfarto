<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-10 col-centered">
            <div class="panel panel-default " style="margin-top: 10px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">INDICADOR ASISTENTE MÉDICA</span>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group">
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
                        <div class="col-md-4">
                            <div class="input-group m-b">
                                <span class="input-group-addon back-imss" style="border:1px solid #256659">
                                    <i class="fa fa-calendar-minus-o"></i>
                                </span>
                                <input type="text" name="inputFecha"  value="<?= date('Y-m-d')?>" class="form-control dp-yyyy-mm-dd" placeholder="Seleccionar Fecha">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <button class="btn back-imss btn-buscar-st7-rc btn-block" >Buscar</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <hr>
                        <div class="col-md-6 text-center col-st7-iniciadas">
                            <a href="#">
                                <h4 class="mayus-bold"> 0 DOCUMENTOS</h4>
                                <h5>TOTAL DE ST7 INICIADAS</h5>
                            </a>
                        </div>
                        <div class="col-md-6 text-center col-st7-terminadas" style="border-left: 2px solid #256659">
                            <a href="#">
                                <h4 class="mayus-bold">0 DOCUMENTOS</h4>
                                <h5>TOTAL DE ST7 TERMINADAS</h5>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <hr>
                        <div class="col-md-6 text-center col-procedencia-espontanea">
                            <a href="#">
                                <h4 class="mayus-bold">0 DOCUMENTOS</h4>
                                <h5>TOTAL DE PROCEDENCIA ESPONTÁNEA</h5>
                            </a>
                        </div>
                        <div class="col-md-6 text-center col-procedencia-no-espontanea" style="border-left: 2px solid #256659">
                            <a href="#">
                                <h4 class="mayus-bold">0 DOCUMENTOS</h4>
                                <h5>TOTAL DE PROCEDENCIA NO ESPONTÁNEA</h5>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <hr>
                        <div class="col-md-12 text-center col-am-total">
                            <h4 class="mayus-bold">TOTAL DE PACIENTES: 0 PACIENTES</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/Asistentemedica.js?').md5(microtime())?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/IdleTimer.js?').md5(microtime())?>" type="text/javascript"></script>