<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <ol class="breadcrumb" style="margin-top: 0px">
            <li><a href="<?= base_url()?>Inicio">Inicio</a></li>
            <li><a href="#">Normativas</a></li>
        </ol> 
        <div class="box-inner col-md-12 col-centered" style="margin-top: 45px">
            <div class="panel panel-default " >
                <div class="panel-body b-b b-light">
                    <div class="row row-normativas"  style="margin-top: -8px"></div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-md-12 text-center">
                            <i class="fa fa-spinner fa-pulse fa-3x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" name="LoadNormativas" value="Si">
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/sections/Normativas.js?'). md5(microtime())?>" type="text/javascript"></script>
