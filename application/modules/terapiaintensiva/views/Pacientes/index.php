<?php echo modules::run('Sections/Menu/index'); ?>
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-7 col-centered">
            <div class="panel panel-default " style="margin-top: 10px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">BUSCAR PACIENTE</span>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon back-imss border-back-imss">
                                        <i class="fa fa-user-circle i-20"></i>
                                    </span>
                                    <input type="number" name="TriageID_TA" min="1" placeholder="INGRESAR N° DE FOLIO..." class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>
    </div>
</div>
<?php echo modules::run('Sections/Menu/footer'); ?>
<script src="<?=  base_url()?>assets/js/TerapiaIntensiva.js?<?= md5(microtime())?>"></script>

