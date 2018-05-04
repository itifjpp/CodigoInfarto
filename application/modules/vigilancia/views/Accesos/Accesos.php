<?= modules::run('Sections/Menu/HeaderBasico'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-sm-6 col-centered" style="margin-top: 10px">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss text-center">
                    <span style="font-size: 20px;font-weight: 500;text-transform: uppercase">
                        <b><?=$this->sigh->getInfo('hospital_tipo')?></b><br>
                        <h5 style="margin-bottom: 0px;"><?=$this->sigh->getInfo('hospital_nombre')?></h5>
                    </span>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="input-group m-b">
                                    <span class="input-group-addon back-imss border-back-imss">
                                        <i class="fa fa-user-plus"></i>
                                    </span>
                                    <input type="text" class="form-control" name="triage_id" placeholder="INGRESAR N° DE FOLIO">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/FooterBasico'); ?>
<script src="<?= base_url('assets/js/Vigilancia.js?').md5(microtime())?>" type="text/javascript"></script>