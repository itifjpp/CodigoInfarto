<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">  
            <div class="col-md-8 col-centered">
                <div class="grid simple" >
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="color-white no-margin">CONFIGURACIÓN ENFERMERÍA OBSERVACIÓN OBSERVACIÓN</h4>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-md-6" >
                                <div class="form-group">
                                    <label class="md-check mayus-bold">
                                        <input type="radio" name="CONFIG_ENFERMERIA_OBSERVACION" data-id="11" value="Si" class="has-value save-config-um" data-value="<?=SiGH_OBSERVACION_ENFERMERIA?>">
                                        <i class="blue"></i>ENFEMERÍA OBSERVACIÓN
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6" >
                                <div class="form-group">
                                    <label class="md-check mayus-bold">
                                        <input type="radio" name="CONFIG_ENFERMERIA_OBSERVACION" data-id="11" value="No" class="has-value save-config-um">
                                        <i class="blue"></i>ENFEMERÍA OBSERVACIÓN POR TIPO
                                    </label>
                                </div>
                            </div>
                            <?php if(SiGH_OBSERVACION_ENFERMERIA=='No'){?>
                            <div class="col-md-12">
                                <h5 style="line-height: 1.5">ENFEMERÍA OBSERVACIÓN POR TIPO: ENFERMERIA OBSERVACIÓN ADULTOS HOMBRES, ADULTOS MUJERES Y PEDIATRIA</h5>
                            </div>
                            <?php }?>
                        </div>
                    </div> 
                </div>       
            </div>
            
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/sections/Configuracion.js?'). md5(microtime())?>" type="text/javascript"></script>