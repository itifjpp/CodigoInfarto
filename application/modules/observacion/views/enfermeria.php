<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-12 ">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin semi-bold color-white"><?=$_SESSION['UMAE_AREA']?></h4>
                        <div style="position: relative;margin-top: 0px">
                            <a href="#" class="btn sigh-background-primary pull-right tip enf-obs-del-paciente" data-placement="bottom" data-original-title="" style="position: absolute;right: 105px;top: -37px">
                                <i class="fa fa-user-times i-24 color-white"></i>
                            </a>
                            <a href="#" class="btn sigh-background-primary pull-right tip actualizar-camas-observacion" data-placement="bottom" data-original-title="Actualizar vista de camas" style="position: absolute;right: 50px;top: -37px">
                                <i class="fa fa-refresh i-24 color-white"></i>
                            </a>
                            <a  href="<?= base_url()?>Observacion/Indicadores/Enfermeria" class="btn sigh-background-primary pull-right tip" data-placement="bottom" data-original-title="Indicadores" style="top:-37px;right: -10px;position: absolute">
                                <i class="fa fa-bar-chart-o i-24 color-white"></i>
                            </a>
                        </div>

                    </div>
                    <?php if(SiGH_OBSERVACION_ENFERMERIA=='No'){?>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-md-12" style="padding: 0px;margin-top: -5px">
                                <div class="col-AjaxLoadCamasTipos"></div>
                            </div>
                        </div>
                    </div>   
                    <?php }?>
                </div>
                
            </div>
        </div>
        <input type="hidden" name="observacion_alta">
        <input type="hidden" name="accion_rol" value="Enfermeria">
        <input type="hidden" name="SiGH_OBSERVACION_ENFERMERIA" value="<?=SiGH_OBSERVACION_ENFERMERIA=='No' ? 'AjaxLoadCamas' : 'AjaxLoadCamasTipo'?>">
        <div class="row ">
            <?php if(SiGH_OBSERVACION_ENFERMERIA=='Si'){?>
            <div class="col-md-12 col-AjaxLoadCamasTipos"></div>
            <?php }?>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/Observacion.js?'). md5(microtime())?>" type="text/javascript"></script>