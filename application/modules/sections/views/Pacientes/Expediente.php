<?= modules::run('Sections/Menu/index'); ?>
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner">
            <div class="col-md-6 col-centered" style="margin-top: 10px">
                <div class="panel panel-default">
                    <div class="panel-heading p teal-900 back-imss">
                        <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">
                            <?=$this->UMAE_AREA?> | BUSCAR PACIENTE
                        </span>
                    </div>
                    <div class="panel-body b-b b-light">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <span class="back-imss input-group-addon no-border-input-icon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <input type="number" name="NumFolio" placeholder="INGRESAR N° DE FOLIO" class="form-control">
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
<script src="<?= base_url('assets/js/sections/Pacientes.js?'). md5(microtime())?>" type="text/javascript"></script>