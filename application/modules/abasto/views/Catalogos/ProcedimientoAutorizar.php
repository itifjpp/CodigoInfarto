<?= modules::run('Sections/Menu/index'); ?>  
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-10 col-centered">
            <div class="box-inner padding">
                <div class="panel panel-default ">
                    <div class="panel-heading p teal-900 back-imss">
                        <span style="font-size: 15px;font-weight: 500;text-transform: uppercase"><b>NUEVO PROCEDIMIENTO</b></span>
                    </div>
                    <div class="panel-body b-b b-light">
                        <form class="autorizar-procedimiento">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="md-form-group" >
                                        <label><b>FECHA DEL PROCEDMIENTO</b></label>
                                        <input class="form-control dd-mm-yyyy" name="fecha_autorizada" required="" placeholder="__/__/____" value="<?= $vale_servicio['vale_fecha_ingreso'] ?>">   
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="md-form-group" >
                                        <label><b>HORA DEL PROCEDMIENTO</b></label>
                                        <input class="form-control clockpicker" name="hora_autorizada" required="" placeholder="00:00" value="<?= $vale_servicio['vale_hora_ingreso'] ?>">   
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="md-form-group">
                                        <label><b>NO. DE SALA</b></label>
                                        <input class="form-control" name="no_sala_autorizada" required="" placeholder="NOMBRE DEL PROCEDIMIENTO" value="<?=$DATOS['contrato_nombre']?>">   
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <input type="hidden" name="csrf_token">
                                    <input type="hidden" name="vale_servicio_id" value="<?= $_GET['vale_servicio_id']?>">
                                    <input type="hidden" name="accion" value="<?= $_GET['accion']?>">
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 30px;">
                                <div class="col-md-6 col-md-offset-6">
                                    <button type="submit" class="md-btn md-raised m-b btn-fw back-imss waves-effect no-text-transform pull-right" style="margin-bottom: -10px">GUARDAR</button>                     
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
<script src="<?= base_url('assets/js/AbsCatalogos.js?').md5(microtime())?>" type="text/javascript"></script>