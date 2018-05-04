<?=Modules::run('Sections/Menu/loadHeaderBasico')?>
<div class="row margin-top-20">
    <div class="col-md-6 col-centered ">
        <div class="grid simple">
            <div class="grid-title sigh-background-secundary ">
                <h1 class="text-center semi-bold text-uppercase color-white width100"><?=$this->sigh->getInfo('hospital_tipo')?></h1>
                <h4 class="text-center semi-bold text-uppercase color-white width100"><?=$this->sigh->getInfo('hospital_clasificacion')?> <?=$this->sigh->getInfo('hospital_nombre')?></h4>
            </div>
            <div class="grid-body">
                <div class="row" >
                    <div class="col-sm-12 margin-top-20"></div>
                    <div class="col-md-12 margin-top-20 margin-bottom-20" style="margin-top: 70px">
                        <button type="button" class="btn sigh-background-secundary btn-circle btn-xl center-content agregar-horacero-paciente-movil" style="width: 300px;height: 300px;border-radius: 150px;font-size: 150px">
                            <i class="fa fa-user-plus"></i>
                        </button>
                        <div class="msj-generando-ticket  text-center hide">
                            <i class="fa fa-spinner fa-pulse fa-5x"></i><br>
                            <h5>IMPRIMIENDO TICKET ESPERE POR FAVOR...</h5>
                        </div>
                    </div>
                    <div class="col-md-12 margin-top-20" style="margin-top: 40px">
                        <div class="md-form-group text-center" >
                            <h5 class="line-height"><?=$this->sigh->getInfo('hospital_direccion')?></h5>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" name="FullScreen" value="Si">
<?= modules::run('Sections/Menu/loadFooterBasico'); ?>
<script src="<?= base_url('assets/js/Horacero.js?').md5(microtime())?>" type="text/javascript"></script>