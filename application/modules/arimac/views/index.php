<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-7 col-centered"> 
            <div class="panel panel-default " style="margin-top: -20px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-align: center!important">
                        <strong>BUSCAR PACIENTE</strong><br>
                    </span>
                </div>
                <div class="panel-body b-b b-light">                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group m-b">
                                <span class="input-group-addon back-imss no-border">
                                    <i class="fa fa-user"></i>
                                </span>
                                <input type="text" name="triage_id" class="form-control" placeholder="Ingresar N° de Paciente">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/Arimac.js?').md5(microtime())?>" type="text/javascript"></script>