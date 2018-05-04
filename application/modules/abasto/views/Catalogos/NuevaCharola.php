<?= modules::run('Sections/Menu/index'); ?>  
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-12 col-centered">
            <div class="box-inner padding">
                <ol class="breadcrumb">
                    <li><a style="text-transform: uppercase" href="<?= base_url()?>Abasto/MinimaInvacion/CategoriasInstrumental">Categoría</a></li>
                    <li><a style="text-transform: uppercase" href="<?= base_url()?>Abasto/MinimaInvacion/Charolas?categoria_id=<?= $_GET['categoria_id']?>&categoria=<?= $_GET['categoria']?>"> <?= $_GET['categoria']?> </a></li>
                    <?php if($_GET['accion']=='edit') {?>
                    <li><a style="text-transform: uppercase" href="#">Editar Charola</a></li>
                    <?php } else { ?>
                    <li><a style="text-transform: uppercase" href="#">Nueva Charola</a></li>
                    <?php }?>
                </ol>
                <div class="panel panel-default ">
                    <div class="panel-heading p teal-900 back-imss">
                        <span style="font-size: 15px;font-weight: 500;text-transform: uppercase"><b><?= $_GET['accion']=='edit'?'EDITAR' : 'NUEVA'?> CHAROLA</b></span>
                    </div>
                    <div class="panel-body b-b b-light">
                        <form class="guardar-charola">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="md-form-group">
                                        <label><b>NOMBRE DE LA CHAROLA</b></label>
                                        <input class="form-control" name="charola_nombre" required="" placeholder="NOMBRE DE LA CHAROLA" value="<?=$CHAROLAS['charola_nombre']?>">   
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="md-form-group">
                                        <label><b>DESCRIPCIÓN</b></label>
                                        <textarea class="form-control" name="charola_descripcion" required="" style="height: 34px;"><?= $CHAROLAS['charola_descripcion']?></textarea>   
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <input type="hidden" name="csrf_token">
                                    <input type="hidden" name="id_categoria" value="<?= $_GET['categoria_id']?>">
                                    <input type="hidden" name="id_charola" value="<?= $_GET['charola_id']?>">
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
