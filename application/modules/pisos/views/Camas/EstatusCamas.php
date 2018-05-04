<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">LIMPIEZA DE CAMAS</span>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row row-camasEstatus"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="PisosAjax" value="EstatusCamas">
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/Pisos.js?'). md5(microtime())?>" type="text/javascript"></script>