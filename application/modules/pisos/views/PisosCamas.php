<?=Modules::run('Sections/Menu/loadHeader'); ?>
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-12 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white text-uppercase">ASIGNACIÓN DE CAMAS: <?=$Piso[0]['piso_nombre']?></h4>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <select class="width100" name="area_id">
                                        <option value="" class="text-uppercase">SELECCIONAR ÁREA</option>
                                        <?php foreach ($Areas as $Areas):?>
                                        <option value="<?=$Areas['area_id']?>" class="text-uppercase"><?=$Areas['area_nombre']?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <input type="hidden" name="piso_id" value="<?=$_GET['piso']?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button class="btn sigh-background-secundary btn-block btn-obtener-camas">Aplicar</button>  
                                </div>
                            </div>
                        </div>
                        <div class="row col-camas">
                            
                        </div>
                        <div class="row">
                            <hr>
                            <h3 class="text-center"><b>CAMAS ASIGNADAS</b></h3><br>
                            <div class="col-camas-asignadas"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/Pisos.js?'). md5(microtime())?>" type="text/javascript"></script>