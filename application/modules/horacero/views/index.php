<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-6 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white text-uppercase semi-bold width100">HORA CERO</h4>
                    </div>
                    <div class="grid-body">
                        <div class="row" style="margin-top: 0px">
                            <div class="col-sm-12">
                                <div class=" text-center">
                                    <h2 class="semi-bold text-uppercase"><?=$this->sigh->getInfo('hospital_clasificacion')?> <?=$this->sigh->getInfo('hospital_tipo')?></h2>
                                    <h5 class="semi-bold text-uppercase"><?=$this->sigh->getInfo('hospital_nombre')?></h5>

                                </div>
                            </div>
                            <div class="col-md-12 margin-top-20">
                                <button type="button" class="btn sigh-background-secundary btn-circle btn-xl center-content agregar-horacero-paciente">
                                    <i class="fa fa-user-plus"></i>
                                </button>
                            </div>
                            <div class="col-md-12 margin-top-20">
                                <h6 class="line-height text-center"><?=$this->sigh->getInfo('hospital_direccion')?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/Horacero.js?').md5(microtime())?>" type="text/javascript"></script>