<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-8 col-centered"> 
            <ol class="breadcrumb" style="margin-top: -30px;color:#2196F3">
                <li><a href="#">Inicio</a></li>
                <li><a href="<?= base_url()?>Finanzas/PreciosAtencion">Precios de Atención</a></li>
                <li><a href="#">Agregar Precios de Atención</a></li>
            </ol> 
            <div class="panel panel-default " style="margin-top: -20px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-align: center!important">
                        <strong>AGREGAR PRECIOS DE ATENCIÓN</strong><br>
                    </span>
                </div>
                <div class="panel-body b-b b-light">                    
                    <div class="row">
                        <div class="col-md-12">
                            <form class="agregar-precios-atencion">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Concepto de Atención</label>
                                            <input type="text" name="pa_concepto" class="form-control" value="<?=$info['pa_concepto']?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Precio de Atención</label>
                                            <input type="number" name="pa_costo" value="<?=$info['pa_costo']?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Descripción de Atención</label>
                                            <textarea class="form-control" name="pa_descripcion"><?=$info['pa_descripcion']?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="csrf_token">
                                            <input type="hidden" name="pa_id" value="<?=$this->uri->segment(4)?>">
                                            <input type="hidden" name="accion" value="<?=$_GET['a']?>">
                                            <button class="btn btn-primary pull-right">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/Finanzas.js?').md5(microtime())?>" type="text/javascript"></script>