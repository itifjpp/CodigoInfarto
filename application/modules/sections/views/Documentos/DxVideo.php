<?= modules::run('Sections/Menu/loadHeaderBasico'); ?> 
<div class="row m-t-5">
    <div class="col-md-12">
        <div class="">
            <div class="grid simple ">
                <div class="grid-title sigh-background-secundary">
                    <h4 class="no-margin color-white">VIDEO INSTRUCTIVO</h4>
                </div>
                <div class="grid-body" style="padding: 0px!important">
                    <div class="card-body" style="padding: 0px">
                        <video autoplay="" style="width: 100%;" controls="">
                            <source src="<?= base_url()?>assets/video/10.mp4" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/loadFooterBasico'); ?>
<script src="<?= base_url('assets/js/sections/Documentos.js?'). md5(microtime())?>" type="text/javascript"></script>
<script src="<?= base_url()?>assets/js/IdleTimer.js?<?= md5(microtime())?>" type="text/javascript"></script>
