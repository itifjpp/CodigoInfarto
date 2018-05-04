<?= modules::run('Sections/Menu/index'); ?>
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-8 col-centered" style="margin-top: 10px">
            <div class="">
                <div class="panel panel-default">
                    <div class="panel-heading p teal-900 back-imss">
                        <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">BUSCAR PACIENTE PARA LA GENERACIÓN DE PASE DE VISITA</span>
                    </div>
                    <div class="panel-body b-b b-light">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="md-check">
                                    <input type="radio" name="tipo_pase" value="Pisos" checked="" >
                                        <i class="blue"></i>PASE PARA PISOS
                                </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <label class="md-check">
                                    <input type="radio" name="tipo_pase" value="Observación">
                                        <i class="blue"></i>PASE PARA OBSERVACIÓN
                                </label>
                            </div>
                            <div class="col-md-12" style="margin-top: 10px">
                                <div class="input-with-icon">
                                    <i class="fa fa-search"></i>
                                    <input type="text" name="triage_id_pv" class="form-control" placeholder="INGRESAR N° DE FOLIO">
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
<script src="<?= base_url('assets/js/AdmisionHospitalaria.js?'). md5(microtime())?>" type="text/javascript"></script>