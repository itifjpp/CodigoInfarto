<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-10 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="color-white no-margin">GESTIÓN DE CAMAS</h4>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" >
                                    <select name="inputAreasObservacion" class="width100">
                                        <option value="">MOSTRAR TODAS LAS CAMAS DE TODAS LAS ÁREAS</option>
                                        <?php 
                                        $sqlObsChoque=$this->config_mdl->sqlQuery("SELECT * FROM sigh_areas WHERE sigh_areas.area_modulo IN('Observación','Choque')");
                                        foreach ($sqlObsChoque as $value) {
                                        ?>
                                        <option value="<?=$value['area_id']?>"><?=$value['area_nombre']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="area_id" value="<?=$AreaSesion?>">
                        <input type="hidden" name="area" value="<?=$this->UMAE_AREA?>">
                        <input type="hidden" name="tipo">
                        <div class="row text-center">
                            <hr>

                            <div class="col-md-3 Total_Camas_Ocupadas pointer" data-area="<?=$AreaSesion?>" data-url="Observacion" data-tipo="Ocupados" >
                                <h2 class="">0 Camas</h2>
                                <h5>Camas Ocupadas</h5>
                            </div>

                            <div class="col-md-3 Total_Camas_Disponibles pointer" data-area="<?=$AreaSesion?>" data-url="Observacion" data-tipo="Disponibles" style="border-left: 2px solid #256659">
                                <h2 class="">0 Camas</h2>
                                <h5>Camas Disponibles</h5>
                            </div>
                            <div class="col-md-3 Total_Camas_Mantenimiento pointer" data-area="<?=$AreaSesion?>" data-tipo="Mantenimiento" style="border-left: 2px solid #256659">
                                <h2 class="">0 Camas</h2>
                                <h5>Camas en Mantenimiento</h6>
                            </div>
                            <div class="col-md-3 Total_Camas_Limpieza pointer" data-area="<?=$AreaSesion?>" data-tipo="Limpieza" style="border-left: 2px solid #256659">
                                <h2 class="">0 Camas</h2>
                                <h5>Camas en Limpieza</h5>
                            </div>
                        </div>
                        <div class="row text-center">
                            <hr>
                            <div class="col-md-12 Total_Camas pointer text-center" data-area="<?=$AreaSesion?>" data-url="Observacion" data-tipo="Total">
                                <h2 class="">0 Camas</h2>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/Observacion.js?'). md5(microtime())?>" type="text/javascript"></script>