<?= modules::run('Sections/Menu/loadHeaderBasico'); ?> 
<div class="row m-t-10">
    <div class="col-md-12">
        <div class="grid simple">
            <div class="grid-title sigh-background-secundary">
                <h4 class="color-white no-margin">AGREGAR CONSULTORIO</h4>
            </div>
            <div class="grid-body">
                <form class="form-guardar-especialidad-cons">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" name="consultorio_nombre" value="<?=$info['consultorio_nombre']?>" required="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="mayus-bold">ES DE ESPECIALIDAD:</label>&nbsp;&nbsp;&nbsp;
                                <label class="md-check">
                                    <input type="radio" name="consultorio_especialidad" value="Si" data-value="<?=$info['consultorio_especialidad']?>">
                                    <i class="blue"></i>Si
                                </label>&nbsp;&nbsp;&nbsp;
                                <label class="md-check">
                                    <input type="radio" name="consultorio_especialidad" value="No" checked="">
                                    <i class="blue"></i>No
                                </label>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="accion" value="<?=$_GET['accion']?>">
                                <input type="hidden" name="especialidad_id" value="<?=$_GET['es']?>">
                                <input type="hidden" name="consultorio_id" value="<?=$_GET['cons']?>"> 
                                <button class="btn sigh-background-secundary btn-block">Guardar</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/loadFooterBasico'); ?>
<script src="<?= base_url('assets/js/sections/Especialidades.js?'). md5(microtime())?>" type="text/javascript"></script>