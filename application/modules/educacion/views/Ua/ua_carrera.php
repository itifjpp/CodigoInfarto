<?= modules::run('Sections/Menu/loadHeaderBasico'); ?> 
<div class="row m-t-10">       
<div class="col-md-8  col-centered" >
    <div class="grid simple">
        <div class="grid-title sigh-background-secundary">
            <h4 class="no-margin semi-bold color-white">AGREGAR NUEVA CARRERA</h4>
        </div>
        <div class="grid-body">                    
            <div class="row">
                <div class="col-md-12">
                    <form class="ua-carrera-agregar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>NOMBRE DE LA CARRERA</label>
                                    <input type="text" required="" name="carrera_nombre" class="form-control" value="<?=$info['carrera_nombre']?>">
                                </div>
                            </div>
                            <div class="col-md-offset-8 col-md-4">
                                <div class="form-group">
                                    <input type="hidden" name="ua_id" value="<?=$_GET['ua']?>">
                                    <input type="hidden" name="carrera_id" value="<?=$_GET['carrera']?>">
                                    <input type="hidden" name="accion" value="<?=$_GET['a']?>">
                                    <button class="btn sigh-background-secundary pull-right btn-block">Guardar</button>
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
<?= modules::run('Sections/Menu/loadFooterBasico'); ?>
<script src="<?= base_url('assets/js/Educacion.js?').md5(microtime())?>" type="text/javascript"></script>