<?= modules::run('Sections/Menu/loadHeaderBasico'); ?> 
<div class="row m-t-5">
    <div class="col-xs-12">
        <div class="grid simple ">
            <div class="grid-title sigh-background-secundary">
                <h4 class="no-margin color-white semi-bold">AGREGAR ÁREA</h4>
            </div>
            <div class="grid-body">
                <form class="form-area-guardar">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label>NOMBRE DEL ÁREA</label>
                                <input type="text" name="area_nombre" placeholder="NOMBRE DEL ÁREA" value="<?=$info['area_nombre']?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label>MODULO</label>
                                <select name="area_modulo" data-value="<?=$info['area_modulo']?>" class="width100">
                                    <option value="">SELECCIONAR MODULO</option>
                                    <option value="Observación">Observación</option>
                                    <option value="Corta Estancia">Corta Estancia</option>
                                    <option value="Pisos">Pisos</option>
                                    <option value="Choque">Choque</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label>HORARIO DE VISITA</label>
                                <input type="text" name="area_horario_visita" placeholder="HORARIO DE VISITA" value="<?=$info['area_horario_visita']?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group mod-genero hide">
                                <select name="area_genero" data-value="<?=$info['area_genero']?>" class="width100">
                                    <option value="">SELECCIONAR TIPO</option>
                                    <option value="Adultos Mujeres">Adultos Mujeres</option>
                                    <option value="Adultos Hombres">Adultos Hombres</option>
                                    <option value="Pediatría">Pediatría</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="hospital_id" data-value="<?=$info['hospital_id']?>" class="width100">
                                    <?php foreach ($Hospitales as $value) {?>
                                    <option value="<?=$value['hospital_id']?>"><?=$value['hospital_clasificacion']?> <?=$value['hospital_tipo']?> <?=$value['hospital_nombre']?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="area_id" value="<?=$_GET['area']?>">
                                <input type="hidden" name="accion" value="<?=$_GET['accion']?>">
                                <input type="hidden" name="SIGH_OBSERVACION_ENFERMERIA" value="<?=SiGH_OBSERVACION_ENFERMERIA?>">
                                <button class="btn sigh-background-secundary btn-block">Guardar</button>
                            </div>  
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/loadFooterBasico'); ?>
<script src="<?= base_url('assets/js/areas/areas.js?').md5(microtime())?>" type="text/javascript"></script>