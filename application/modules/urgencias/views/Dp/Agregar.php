<?=Modules::run('Sections/Menu/loadHeaderBasico'); ?>
<div class="row m-t-10">
    <div class="col-md-12">
        <div class="">
            <div class="grid simple">
                <div class="grid-title sigh-background-secundary">
                    <h4 class="no-margin color-white">NUEVA DISTRIBUCIÓN DE PERSONAL<</h4>
                </div>
                <div class="grid-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-add-dp">
                                <div class="form-group m-b-5">
                                    <label class="mayus-bold">SELECCIONAR FECHA</label>
                                    <input type="text" name="distribucion_fecha" required="" class="form-control dp-yyyy-mm-dd">
                                </div>
                                <div class="form-group m-t-5 m-b-5">
                                    <label class="mayus-bold">TURNO</label>
                                    <select name="distribucion_turno" required="" class="width100">
                                        <option value="">SELECCIONAR TARNO</option>
                                        <option value="Mañana">Mañana</option>
                                        <option value="Tarde">Tarde</option>
                                        <option value="Noche">Noche</option>
                                    </select>
                                </div>
                                <div class="form-group m-t-5 m-b-5">
                                    <label class="semi-bold">SELECCIONAR JEFE URGENCIAS</label>
                                    <select name="empleado_id" class="select2 width100" required="">
                                        <option value="">SELECCIONAR UN REGISTRO...</option>
                                        <?php foreach ($Empleados as $value) {?>
                                        <option value="<?=$value['empleado_id']?>"><?=$value['empleado_nombre']?> <?=$value['empleado_ap']?> <?=$value['empleado_am']?> - <?=$value['empleado_matricula']?></option>
                                        <?php }?>
                                    </select>
                                    <input type="hidden" name="csrf_token">
                                </div>
                                <div class="form-group">
                                    <button class="btn sigh-background-secundary pull-right">GUARDAR</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?=Modules::run('Sections/Menu/loadFooterBasico'); ?>
<script src="<?=  base_url()?>assets/js/Chart.js" type="text/javascript"></script>
<script src="<?=  base_url()?>assets/js/Urgencias.js?<?= md5(microtime())?>"></script>

