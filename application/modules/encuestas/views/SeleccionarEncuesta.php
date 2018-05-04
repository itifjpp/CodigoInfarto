<?= modules::run('Sections/Menu/loadHeaderBasico'); ?> 
<div class="row m-t-10">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-centered">
        <div class="grid simple">
            <div class="grid-title p pantalla-completa sigh-background-secundary">
                <h2 class="color-white no-margin semi-bold text-center"><?=$this->sigh->getInfo('hospital_clasificacion')?> <?=$this->sigh->getInfo('hospital_tipo')?></h2>
                <h3 class="color-white no-margin text-center"><?=$this->sigh->getInfo('hospital_nombre')?></h3>
            </div>
        </div>
            <?php if(!empty($Encuestas)){?>
            <?php foreach ($Encuestas as $value) {?>
            <div class="grid simple">
                <div class="grid-body">
                    <a href="<?= base_url()?>Ensat/Encuesta?en=<?= base64_encode($value['encuesta_id'])?>&tipo=Anónimo&triage_id=0">
                        <div class="row">
                            <div class="col-xs-11">
                                <h3 class="no-margin text-uppercase line-height"><?=$value['encuesta_nombre']?></h3>
                                <hr class="hr-style2">
                                <h4><b>FECHA Y HORA</b> <?=$value['encuesta_fecha']?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ÁREA</b> <?=$value['encuesta_area']?></h4>
                            </div>
                            <div class="col-xs-1">
                                <i class="fa fa-chevron-right sigh-color" style="font-size: 60px;margin-top: calc(50%)"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
                <?php }?>
            <?php }else{?>
            <div class="grid simple">
                <div class="grid-body">
                    <h3 class="text-center">NO HAY ENCUESTAS DISPONIBLES</h3>
                </div>
            </div>
            <?php }?>  
    </div>
</div>
<?= modules::run('Sections/Menu/loadFooterBasico'); ?>

<script src="<?= base_url('assets/js/Ensat.js?').md5(microtime())?>" type="text/javascript"></script>