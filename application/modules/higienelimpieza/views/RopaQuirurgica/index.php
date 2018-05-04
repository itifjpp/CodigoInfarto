<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-8 col-centered">
            <div class="panel panel-default " style="margin-top: 10px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">REPORTE DE PRESTACIONES DE ROPA QUIRÚRGICA AL PERSONAL</span>

                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group"> 
                                <input type="text" name="inputDateStart" class="form-control dp-yyyy-mm-dd" placeholder="ESPECIFICAR FECHA DE INICIO">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" name="inputDateEnd" class="form-control dp-yyyy-mm-dd" placeholder="ESPECIFICAR FECHA DE TERMINO">
                                <span class="input-group-btn">
                                    <button class="btn btn-default waves-effect btnReporteRopaQuirurgica" type="button">BUSCAR</button>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-12 hide col-ReporteRopaQuirurgica">
                            <div class="alert alert-info">
                                <h3 class="no-margin"><b>TOTAL:</b> <span class="msjReporteRopaQuirurgicaTotal">120</span> REGISTROS ENCONTRADOS</h3>
                                <button class="btn back-imss btnReporteRopaQuirurgicaDPF" style="margin: 10px auto 0px;display: table"><i class="fa fa-cloud-download"></i> GENERAR PDF</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/HigieneLimpieza.js?').md5(microtime())?>" type="text/javascript"></script>