<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">LIMPIEZA DE CAMAS</span>
                </div>
                <div class="panel-body b-b b-light">
                    <?php if($this->UMAE_AREA=='Administrador'){?>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <select class="form-control" name="area_id_lc">
                                    <option value="">SELECCIONAR ÁREA</option>
                                    <?php foreach ($Areas as $value):?>
                                    <option value="<?=$value['area_id']?>"><?=$value['area_nombre']?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <?php }else{?>
                    <input type="hidden" name="filtro_camas_por_piso" value="Pisos">
                    <?php }?>
                    <div class="row row-camas">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/Pisos.js?'). md5(microtime())?>" type="text/javascript"></script>