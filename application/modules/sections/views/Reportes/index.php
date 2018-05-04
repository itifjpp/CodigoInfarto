<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-10 col-centered">
        <div class="box-inner padding">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss text-center">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">
                        <b>INDICADORES</b>
                    </span>
                    
                </div>
                <div class="panel-body b-b b-light">
                    <div class="card-body">
                        <div class="row" style="margin-top: -10px">
                            <form class="form-reportes" method="GET" action="<?= base_url()?>Sections/Reportes/ReporteGeneral">
                                <div class="col-md-4 " >
                                    <div class="input-group m-b">
                                        <span class="input-group-addon back-imss" style="border:1px solid #256659">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="text" name="inputFechaInicio" required="" class="form-control dp-yyyy-mm-dd" placeholder="Fecha de Inicio">
                                    </div>
                                </div>
                                <div class="col-md-4 " >
                                    <div class="input-group m-b">
                                        <span class="input-group-addon back-imss dp-yyyy-mm-dd" style="border:1px solid #256659">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="text" name="inputFechaTermino" required="" class="form-control dp-yyyy-mm-dd" placeholder="Fecha de Termino">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <button class="btn back-imss btn-block">Aceptar</button>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <hr>
                                </div>

                                <div class="col-md-4">
                                    <h5></h5>
                                </div>
                            </form>
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