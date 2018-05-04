<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="panel panel-default " style="margin-top: -20px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase"><?=$this->UMAE_AREA?></span>
                </div>
                <div class="panel-body b-b b-light">
                    <input type="hidden" name="qp_alta" value="Alta a domicilio">
                    <div class="row row-quirofanos"></div>
                    <input type="hidden" name="LoadView" value="False">
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/Quirofano.js?'). md5(microtime())?>" type="text/javascript"></script>