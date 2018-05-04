<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-12 col-centered" style="margin-top: 10px">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">RESULTADOS DE ENCUESTA APLICADAS A PACIENTES</span>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group m-b">
                                <span class="input-group-addon back-imss border-back-imss">
                                    <i class="fa fa-clock-o"></i>
                                </span>
                                <select class="form-control" name="inputTurno">
                                    <option value="Mañana">MAÑANA</option>
                                    <option value="Tarde">TARDE</option>
                                    <option value="Noche">NOCHE</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group m-b">
                                <span class="input-group-addon back-imss border-back-imss">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input type="text" name="inputFecha" placeholder="SELECCIONAR FECHA" value="<?=  date('Y-m-d')?>" class="form-control dp-yyyy-mm-dd">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button class="btn back-imss btn-block btn-ajax-resultados-ensat">Buscar</button>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12" style="padding: 0px">
                                            <h2 style="margin: 0px"><b><i class="fa fa-pencil-square-o color-imss"></i> RESULTADO DE LA ENCUESTA DE SATISFACCIÓN</b></h2>
                                        </div><br>
                                    </div>
                                    <div class="row row-result-ensat-loading hide" style="margin-top: 20px">
                                        <div class="col-md-12 text-center">
                                            <br>
                                            <i class="fa fa-spinner fa-pulse fa-4x"></i>
                                        </div>
                                    </div>
                                    <div class="row row-result-ensat row-result-ensat-load " style="margin-top: 20px"></div>
                                    <div class="row">
                                        <div class="col-md-12 row-result-ensat-load hide text-center">
                                            <h3><b>TOTAL DE ENCUESTAS REALIZADAS: <span class="ensat-total-encuestas"></span></b></h3>
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
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/Ensat.js?').md5(microtime())?>" type="text/javascript"></script>