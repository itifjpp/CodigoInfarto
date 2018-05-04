<?= modules::run('Sections/Menu/loadHeaderBasico'); ?>
<link href="<?= base_url()?>assetsv2/plugins/webcam/wc.css" type="text/css" rel="stylesheet">
<div class="row m-t-5">
    <div class="col-md-12 no-padding">
        <div class="center-content">
            <div id="retrievingfilename" class="html5imageupload" data-width="640" data-height="480" data-url="<?=  base_url()?>config/uploadImageTmp?tipo=img/perfiles" style="width: 640px;height: 480px">
                <input type="file" name="thumb" style="height: 200px!important">
            </div>
        </div>
        <input type="hidden" name="uploadImageTmp" id="filename"  class="form-control">
        <a href="" class="md-btn md-fab md-fab-bottom-right pos-fix blue upload-foto" style="width: 80px;height: 80px;z-index: 1000" >
            <i class="material-icons i-24 color-white" style="vertical-align: -65%;font-size: 40px ">check</i>
        </a>
    </div>
</div>
<?= modules::run('Sections/Menu/loadFooterBasico'); ?>
<script src="<?= base_url()?>assets/js/Usuarios.js?<?= md5(microtime())?>" type="text/javascript"></script> 

