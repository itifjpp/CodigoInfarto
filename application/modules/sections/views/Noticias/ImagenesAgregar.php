<?= modules::run('Sections/Menu/loadHeaderBasico'); ?> 
<div class="row m-t-10">
    <div class="col-md-12">
        <div class="grid simple">
            <div class="grid-title sigh-background-secundary">
                <h4 class="no-margin color-white">SELECCIONAR IMAGEN</h4>
            </div>
            <div class="grid-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="center-content">
                            <div id="retrievingfilename" class="html5imageupload" data-width="600" data-height="500" data-url="<?=  base_url()?>config/uploadImageTmp?tipo=Noticias" style="width: 600px;height: 500px;">
                                <input type="file" name="thumb" style="height: 400px!important">
                            </div>
                            <form class="form-add-noticia-img">
                                <input type="hidden" name="img_url" id="filename"  class="form-control" />
                                <input type="hidden" name="noticia_id" value="<?=$_GET['noticia']?>">
                                <input type="hidden" name="csrf_token" >
                                <button class="md-btn md-fab md-fab-bottom-right pos-fix blue">
                                    <i class="fa fa-check i-24 color-white"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/loadFooterBasico'); ?>
<script src="<?= base_url('assets/js/sections/Noticias.js?'). md5(microtime())?>" type="text/javascript"></script>