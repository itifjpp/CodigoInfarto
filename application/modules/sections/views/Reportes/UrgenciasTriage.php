<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-8 col-centered" style="margin-top: 10px">
        <div class="box-inner">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss text-center">
                    <span style="font-size: 13px;font-weight: 500;text-transform: uppercase">
                        <b>REPORTES URGENCIAS/TRIAGE</b>
                    </span>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-md-4 " >
                            <div class="input-group m-b">
                                <span class="input-group-addon back-imss dp-yyyy-mm-dd" style="border:1px solid #256659">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input type="text" name="inputFecha1" required="" class="form-control dp-yyyy-mm-dd" placeholder="Fecha Inicio">
                            </div>
                        </div>
                        <div class="col-md-4 " >
                            <div class="input-group m-b">
                                <span class="input-group-addon back-imss dp-yyyy-mm-dd" style="border:1px solid #256659">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input type="text" name="inputFecha2" required="" class="form-control dp-yyyy-mm-dd" placeholder="Fecha Termino">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <button class="btn back-imss btn-block btn-buscar">Aceptar</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-result hide">
                            <div class="alert alert-info" style="padding-bottom: 0px;padding-top: 0px;">
                                <h5>TOTAL DE REGISTROS ENCONTRADOS: </h5>
                                <a href="" class="link-download-report" style="position: absolute;top: 7px;right: 29px;">
                                    <i class="fa fa-cloud-download i-24"></i>
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
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?=  base_url()?>assets/js/Chart.js" type="text/javascript"></script>
<script src="<?= base_url('assets/js/sections/Reportes.js?md5').md5(microtime())?>" type="text/javascript"></script>