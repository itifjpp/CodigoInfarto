<?= modules::run('Sections/Menu/HeaderBasico'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-8 col-centered" style="margin-top: 10px">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">AGREGAR SUBESPECIALIDAD</span>
                </div>
                <div class="panel-body b-b b-light">
                    <form class="form-guardar-especialidad-sub">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="text" name="sub_nombre" value="<?=$info['sub_nombre']?>" required="" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="accion" value="<?=$_GET['accion']?>">
                                    <input type="hidden" name="especialidad_id" value="<?=$_GET['es']?>">
                                    <input type="hidden" name="especialidad_id" value="<?=$_GET['sub']?>"> 
                                    <input type="hidden" name="csrf_token">
                                    <button class="btn back-imss btn-block">Guardar</button>
                                </div>
                            </div>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/FooterBasico'); ?>
<script src="<?= base_url('assets/js/sections/Especialidades.js?'). md5(microtime())?>" type="text/javascript"></script>