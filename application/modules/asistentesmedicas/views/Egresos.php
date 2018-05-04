<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-6 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white semi-bold width100">EGRESOS DE PACIENTES DE LA UNIDAD MÉDICA</h4>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <div class="input-group">
                                        <span class="input-group-addon no-border sigh-background-secundary">
                                            <i class="fa fa-user-plus"></i>
                                        </span>
                                        <input type="number" class="form-control" id="ingreso_id_egreso" placeholder="INGRESAR N° DE FOLIO DEL PACIENTE">
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
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/Asistentemedica.js?'). md5(microtime())?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/IdleTimer.js?').md5(microtime())?>" type="text/javascript"></script>