<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">GESTIÓN DE CAMAS</span>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row" style="margin-top: 15px">
                        <div class="col-md-6">
                            <div class="form-group" >
                                <select name="SELECCIONAR_AREA" style="text-transform: uppercase" <?=$this->UMAE_AREA!='Administrador' ? 'disabled' : ''?> class="form-control">
                                    <option value="">MOSTRAR TODAS LAS CAMAS DE TODAS LAS ÁREAS</option>
                                    <?php foreach ($Areas as $value){?>
                                    <option value="<?=$value['area_id']?>"><?=$value['area_nombre']?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="area_id" value="<?=$AreaSesion?>">
                    <input type="hidden" name="area" value="<?=$this->UMAE_AREA?>">
                    <input type="hidden" name="tipo">
                    <div class="row text-center">
                        <hr>
                        <div class="col-md-4 Total_Camas pointer" data-area="<?=$AreaSesion?>" data-tipo="Total">
                            <h2 class="">20 Camas</h2>
                            <h5><b>Total de Camas</b></h5>
                        </div>
                        <div class="col-md-4 Total_Camas_Ocupadas pointer" data-area="<?=$AreaSesion?>" data-tipo="Ocupados" style="border-left: 2px solid #256659">
                            <h2 class="">20 Camas</h2>
                            <h5><b>Total de Camas Ocupadas</b></h5>
                        </div>
                        
                        <div class="col-md-4 Total_Camas_Disponibles pointer" data-area="<?=$AreaSesion?>" data-tipo="Disponibles" style="border-left: 2px solid #256659">
                            <h2 class="">20 Camas</h2>
                            <h5><b>Total de Camas Disponibles</b></h5>
                        </div>
                        
                    </div>
                    <div class="row text-center">
                        <hr>
                        <div class="col-md-4 Total_Camas_Mantenimiento pointer" data-area="<?=$AreaSesion?>" data-tipo="Mantenimiento" >
                            <h2 class="">20 Camas</h2>
                            <h5>Total de Camas en Mantenimiento</</h6>
                        </div>
                        <div class="col-md-4 Total_Camas_Limpieza pointer" data-area="<?=$AreaSesion?>" data-tipo="Limpieza" style="border-left: 2px solid #256659">
                            <h2 class="">20 Camas</h2>
                            <h5>Total de Camas en Limpieza</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/sections/Camas.js?'). md5(microtime())?>" type="text/javascript"></script>