<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase"><?=$this->UMAE_AREA?></span>
                </div>
                <div class="panel-body b-b b-light">
                    <h1 class="text-center"><i class="fa fa-warning " style="color: #f44336"></i> NO DISPONIBLE</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/sections/Camas.js?'). md5(microtime())?>" type="text/javascript"></script>