<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-12">
            <a href="#" class="md-btn md-fab md-fab-top-right pos-fix red ajax-del43052" style="top: 75px;position: absolute;right: 80px">
                <i class="fa fa-user-times i-24 text-color-white tip" ></i>
            </a>
            <a href="#" class="md-btn md-fab md-fab-top-right pos-fix red ajax-load-camas" style="top: 75px">
                <i class="fa fa-refresh i-24 text-color-white tip" ></i>
            </a>
            <div class="row " style="margin-top: 10px">   
                <div class="col-md-12">
                    <div class="panel-group visor-camas" id="accordion"></div>
                </div>

            </div>
        </div>
    </div>
</div>
<input type="hidden" name="AdmisionHospitalaria">
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/AdmisionHospitalaria.js?'). md5(microtime())?>" type="text/javascript"></script>