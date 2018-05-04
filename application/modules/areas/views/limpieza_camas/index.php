<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12">
              
            <div class="panel panel-default " style="margin-top: -20px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase"><?=$_SESSION['UMAE_AREA']?></span>
                    
                </div>
                <div class="panel-body b-b b-light">
                    <div class="" >
                        <div class="row">
                            <?php if(!isset($_GET['acceso'])){?>
                            <?php foreach ($Gestion as $gestion){?>
                            <div class="col-md-3">
                                <label class="md-check">
                                    <input type="radio" name="area_nombre" value="<?=$gestion['area_id']?>" class="has-value"><i class="indigo"></i><?=$gestion['area_nombre']?>
                                </label>
                            </div>
                            <?php }?>
                            
                            <?php }?>
                            <?php
                            if($_SESSION['UMAE_AREA']=='Enfermería Observación Adultos Hombres' && $_GET['acceso']){
                                $area='5';
                            }if($_SESSION['UMAE_AREA']=='Enfermería Observación Adultos Mujeres' && $_GET['acceso']){
                                $area='4';
                            }if($_SESSION['UMAE_AREA']=='Enfermería Observación Pediatría' && $_GET['acceso']){
                                $area='3';
                            }if($_SESSION['UMAE_AREA']=='Enfermería Choque' && $_GET['acceso']){
                                $area='6';
                            }?>
                            <input type="hidden" name="BY_AREA" value="<?=$area?>">
                        </div>
                        <hr>
                        <div class="row">
                            <style>.color-white{color: white!important;}</style>
                            <div class="col-md-12">
                                <div class="result_camas"></div>
                                <h3 class="NO_HAY_CAMAS text-center hidden">HO HAY CAMAS DISPONIBLES PARA ESTA AREA</h3>
                            </div>
                        </div>
                    <input type="hidden" name="observacion_alta">
                    <input type="hidden" name="accion_rol" value="Enfermeria">
                </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/os/limpiezacamas.js')?>" type="text/javascript"></script>