<?= modules::run('Sections/Menu/loadHeaderBasico'); ?> 
<div class="row m-t-25">
    <div class="col-md-12">
        <div class="">
    
            <div class="grid simple">
                <div class="grid-title sigh-background-secundary ">
                    <h4 class="color-white no-margin text-uppercase">Nuevo Contenido</h4>
                </div>
                <div class="grid-body">
                    <form  class="guardar-contenido">
                    <div class="row">
                        <div class="col-xs-12">
                                <div class="form-group">
                                    <textarea rows="10" class="form-control" name="contenido_datos"><?=$info['contenido_datos']?></textarea>
                                </div>
                                <input type="hidden" name="contenido_id" value="<?=$_GET['con']?>">
                                <input type="hidden" name="plantilla_id" value="<?=$_GET['plantilla']?>">
                                <input type="hidden" name="accion" value="<?=$_GET['a']?>">
                        </div>
                        <div class="col-xs-offset-8 col-xs-4">
                            <button class="btn sigh-background-primary btn-block">Guardar</button>
                        </div>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/loadFooterBasico'); ?>
<script src="<?= base_url('assets/js/sections/Plantillas.js?').md5(microtime())?>" type="text/javascript"></script>