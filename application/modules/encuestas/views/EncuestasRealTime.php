<?= modules::run('Sections/Menu/loadHeaderBasico'); ?> 
<div class="row m-t-10">
    <div class="col-md-11 col-centered">
        <div class="grid simple ">
            <div class="grid-title sigh-background-secundary">
                <h4 class="no-margin color-white">RESULTADO DE LA ENCUESTA DE SATISFACCIÓN</h4>
            </div>
            <div class="grid-body">
                <div class="row ">
                    <div class="col-md-4">
                         <h4 style="margin: 0px 0px 2px 0px;" class="result-ensat-fecha text-uppercase"></h4>
                    </div>
                    <div class="col-md-4">
                        <h4 style="margin: 0px 0px 2px 0px;" class="result-ensat-turno text-uppercase"></h4>
                    </div>
                    <div class="col-md-4">
                        <h4 style="margin: 0px 0px 8px 0px;" class="result-ensat-total text-uppercase"></h4>
                    </div>
                    <div class="col-md-12">
                        <hr class="hr" style="margin: 0px 0px 10px 0px">
                    </div>
                </div>
                <div class="row-result-ensat row-result-ensat-load "></div>
            </div>

        </div>
    </div>
</div>
<input type="hidden" name="EnsatRealTime" value="Si">
<?= modules::run('Sections/Menu/loadFooterBasico'); ?>
<script src="<?= base_url('assets/js/Ensat.js?').md5(microtime())?>" type="text/javascript"></script>