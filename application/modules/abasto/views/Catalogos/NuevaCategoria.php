<?= modules::run('Sections/Menu/index'); ?>  
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-12 col-centered">
                <div class="box-inner padding">
                    <ol class="breadcrumb" style="margin-top:">
                    <li><a style="text-transform: uppercase" href="#">Categoría</a></li>
                    <li><a style="text-transform: uppercase" href="#"><?= $_GET['accion']=='edit'?'EDITAR' : 'NUEVA'?> Categoría</a></li>
                </ol>
                <div class="panel panel-default ">
                    <div class="panel-heading p teal-900 back-imss">
                        <span style="font-size: 15px;font-weight: 500;text-transform: uppercase"><b><?= $_GET['accion']=='edit'?'EDITAR' : 'NUEVA'?> CATEGORÍA</b></span>
                    </div>
                    <div class="panel-body b-b b-light">
                        <form class="guardar-categoria">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="md-form-group">
                                        <label><b>NOMBRE DE LA CATEGORÍA</b></label>
                                        <input class="form-control" name="categoria_nombre" required="" placeholder="NOMBRE DE LA CATEGORIA" value="<?=$categoria['categoria_nombre']?>">   
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="md-form-group">
                                        <label><b>DESCRIPCIÓN</b></label>
                                        <textarea class="form-control" name="categoria_descripcion" required="" style="height: 34px;"><?= $categoria['categoria_descripcion']?></textarea>   
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <input type="hidden" name="csrf_token">
                                    <input type="hidden" name="categoria_tipo" value="<?= $_GET['name']?>">
                                    <input type="hidden" name="categoria_id" value="<?= $_GET['id_categoria']?>">
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
