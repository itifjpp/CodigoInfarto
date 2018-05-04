<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding" style="margin-top: -20px">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500"><b>VISOR DE CAMAS</b></span>
                    <?php if($this->UMAE_AREA=='CADIT'){?>
                    <a href="<?=  base_url()?>Pisos/Camas/Indicador" target="_blank" md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right tip " data-original-title="Indicadores">
                        <i class="fa fa-bar-chart i-24"></i>
                    </a>
                    <?php }?>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-md-12">
                            <b>CAMAS DISPONIBLES :</b> <span class="visor-camas-disponibles">0</span> &nbsp;&nbsp;
                            <b>CAMAS OCUPADAS :</b> <span class="visor-camas-ocupadas">0</span> &nbsp;&nbsp;
                            <b>CAMAS EN MANTENIMIENTO :</b> <span class="visor-camas-enmantenimiento">0</span> &nbsp;&nbsp;
                            <b>CAMAS EN LIMPIEZA :</b> <span class="visor-camas-enlimpieza">0</span> &nbsp;&nbsp;
                            <b>CAMAS DESCOMPUESTAS :</b> <span class="visor-camas-descompuestas">0</span>
                        <br><br>
                    </div>
                    <div class="row row-camas-visor">
                        
                    </div>
                </div>
                <input type="hidden" name="VisorCamas" value="Visor de Camas">
                <a href="" class="md-btn md-fab md-fab-bottom-right pos-fix teal actualizar-visor">
                    <i class="mdi-action-cached i-24"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/Pisos.js?'). md5(microtime())?>" type="text/javascript"></script>