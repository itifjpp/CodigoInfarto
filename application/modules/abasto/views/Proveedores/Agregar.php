<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-6 col-centered" style="margin-top: 10px">
        <div class="box-inner">
            <div class="panel panel-default">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">
                        <b>NUEVO PROVEEDOR</b>&nbsp;
                    </span>
                </div>
                <div class="panel-body b-b b-light">
                    <form class="guardar-proveedor">
                        <div class="row" >
                            <div class="col-md-12">
                                <div class="form-group" >
                                    <label><b>NOMBRE</b> </label>
                                    <input class="form-control" name="proveedor_nombre" required=""  value="<?=$info['proveedor_nombre']?>">   
                                </div>
                            </div>
                            <div class="col-md-12">
                                <input type="hidden" name="proveedor_id" value="<?=$_GET['proveedor']?>">
                                <input type="hidden" name="csrf_token" >
                                <input type="hidden" name="accion" value="<?=$_GET['accion']?>">
                                <button class="md-btn md-raised m-b btn-fw back-imss waves-effect no-text-transform pull-right" type="submit" style="margin-bottom: -10px">Guardar</button>                     
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
<script src="<?= base_url('assets/js/Abasto/AbsProveedor.js?').md5(microtime())?>" type="text/javascript"></script>