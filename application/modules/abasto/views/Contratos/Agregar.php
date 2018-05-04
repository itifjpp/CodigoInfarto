<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-6 col-centered" style="margin-top: 10px">
        <div class="box-inner">
            <div class="panel panel-default">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">
                        <b>NUEVO CONTRATO</b>&nbsp;
                    </span>
                </div>
                <div class="panel-body b-b b-light">
                    <form class="guardar-contratos">
                        <div class="row" >
                            <div class="col-md-12">
                                <div class="form-group" >
                                    <label><b>NOMBRE</b> </label>
                                    <input class="form-control" name="contrato_nombre" required=""  value="<?=$info['contrato_nombre']?>">   
                                </div>
                                <div class="form-group">
                                    <label class="mayus-bold">PROVEEDOR</label>
                                    <select class="form-control" name="proveedor_id" data-value="<?=$info['proveedor_id']?>" required="">
                                        <option value="">SELECCIONAR PROVEEDOR</option>
                                        <?php foreach ($Proveedores as $value) {?>
                                        <option value="<?=$value['proveedor_id']?>"><?=$value['proveedor_nombre']?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-offset-8 col-md-4">
                                <input type="hidden" name="contrato_id" value="<?=$_GET['contrato']?>">
                                <input type="hidden" name="csrf_token" >
                                <input type="hidden" name="accion" value="<?=$_GET['accion']?>">
                                <button class="pull-right btn back-imss btn-block" type="submit" >Guardar</button>                     
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/Abasto/AbsContratos.js?').md5(microtime())?>" type="text/javascript"></script>