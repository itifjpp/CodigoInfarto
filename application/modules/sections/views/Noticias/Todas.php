<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <ol class="breadcrumb" style="margin-top: 0px">
            <li><a href="<?= base_url()?>Inicio">Inicio</a></li>
            <li><a href="#">Noticias</a></li>
        </ol> 
        <div class="box-inner col-md-12 col-centered" style="margin-top: 45px">
            <div class="panel panel-default " >
                <div class="panel-body b-b b-light">
                    <div class="row row-noticias"  style="margin-top: -8px">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" name="LoadNoticias" value="Si">
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/sections/Noticias.js?'). md5(microtime())?>" type="text/javascript"></script>
