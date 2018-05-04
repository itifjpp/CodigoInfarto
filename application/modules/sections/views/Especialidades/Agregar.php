<?= modules::run('Sections/Menu/loadHeaderBasico'); ?> 
<div class="row m-t-10">
    <div class="col-md-12">
        <div class="grid simple">
            <div class="grid-title sigh-background-secundary">
                <h4 class="no-margin color-white">AGREGAR ESPECIALIDAD</h4>
            </div>
            <div class="grid-body">
                <form class="form-guardar-especialidad">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <input type="text" name="especialidad_nombre" value="<?=$info['especialidad_nombre']?>" required="" class="form-control">
                            </div>
                            
                            
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label class="mayus-bold">TIENE CONSULTORIOS:</label>&nbsp;&nbsp;&nbsp;
                                <label class="md-check">
                                    <input type="radio" name="especialidad_consultorios" value="Si" data-value="<?=$info['especialidad_consultorios']?>">
                                    <i class="blue"></i>Si
                                </label>&nbsp;&nbsp;&nbsp;
                                <label class="md-check">
                                    <input type="radio" name="especialidad_consultorios" value="No" checked="">
                                    <i class="blue"></i>No
                                </label>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label class="mayus-bold">INGRESO-EGRESO 43029:</label>&nbsp;&nbsp;&nbsp;
                                <label class="md-check">
                                    <input type="radio" name="especialidad_43029" value="Si" data-value="<?=$info['especialidad_43029']?>">
                                    <i class="blue"></i>Si
                                </label>&nbsp;&nbsp;&nbsp;
                                <label class="md-check">
                                    <input type="radio" name="especialidad_43029" value="No" checked="">
                                    <i class="blue"></i>No
                                </label>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="accion" value="<?=$_GET['accion']?>">
                                <input type="hidden" name="especialidad_id" value="<?=$_GET['es']?>">
                                <input type="hidden" name="csrf_token">
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