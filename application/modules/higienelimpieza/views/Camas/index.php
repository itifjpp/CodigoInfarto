<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-12 col-centered">
            <div class="panel panel-default " style="margin-top: 10px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">GESTIÓN DE CAMAS</span>
                    <a href="#" onclick="AbrirDocumentoMultiple(base_url+'Inicio/Documentos/HL_CL','Camas En Limpieza',200)" md-ink-ripple=""class="md-btn btn-add-sala md-fab m-b red waves-effect pull-right" style="position: absolute;right: 10px">
                        <i class="fa fa-file-pdf-o i-24"></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row row-camas-limpieza"></div>
                </div>
            </div>
            
    </div>
</div>
    <input name="LoadCamasLimpieza" value="Si">
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/HigieneLimpieza.js?').md5(microtime())?>" type="text/javascript"></script>