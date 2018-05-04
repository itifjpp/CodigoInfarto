<?= modules::run('Sections/Menu/index'); ?>  
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-12 col-centered">
            <div class="box-inner padding">
                <ol class="breadcrumb">
                    <li><a style="text-transform: uppercase" href="#">Mínima Invasión</a></li>
                    <li><a style="text-transform: uppercase" href="<?= base_url()?>">Categoría</a></li>
                    <li><a style="text-transform: uppercase" href="<?= base_url()?>"> <?= $_GET['categoria']?> </a></li>
                    <li><a style="text-transform: uppercase" href="#">Instrumental</a></li>
                    <?php if($_GET['accion']=='edit') {?>
                    <li><a style="text-transform: uppercase" href="#">Editar Instrumental</a></li>
                    <?php } else { ?>
                    <li><a style="text-transform: uppercase" href="#">Nueva Instrumental</a></li>
                    <?php }?>
                </ol>
                <div class="panel panel-default">
                    <div class="panel-heading p teal-900 back-imss">
                        <span style="font-size: 15px;font-weight: 500;text-transform: uppercase"><b><?= $_GET['accion']=='edit'?'EDITAR' : 'NUEVA'?> INSTRUMENTAl</b></span>
                    </div>
                    <div class="panel-body b-b b-light">
                        <form class="guardar-instrumental">
                            <div class="row">
                                <div class="col-md-3" style="margin-top: -1px;">
                                    <div class="md-form-group">
                                        <label><b>CONTRATO</b></label>
                                        <select id="multi" name="contrato_id" data-value="<?= $DATOS['contrato_nombre']?>" class="select2" style="width:100%">
                                            <?php foreach ($CONTRATOS as $val){ ?>
                                            <option value="<?=$val['contrato_id']?>" ><?= $val['contrato_nombre']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="md-form-group">
                                        <label><b>NOMBRE DEL INSTRUMENTAL</b></label>
                                        <input class="form-control" name="nombre_instrumental" required="" placeholder="NOMBRE DEL INSTRUMENTAL" value="<?= $DATOS['instrumental_nombre']?>">   
                                    </div>
                                </div>
                                <?php if(isset($_GET['instrumental_id'])) { ?>
                                <div class="col-md-6">
                                    <div id="imagenNew_inst_equip" class="md-form-group hidden">
                                        <label><b>IMAGEN</b></label>
                                        <input type="file" name="instrumental_imagen" id="vale_evidencias" class="form-control upload-archivo">
                                    </div>
                                    <div id="imagen_inst_equip" class="" style="margin-top: 20px;"><label><b>IMAGEN</b></label>
                                        <div class="md-form-group" style="margin-top: -18px;">
                                            <img src="<?= base_url()?>assets/evidencias_procedimiento/<?= $DATOS['instrumental_imagen']?>" style="width: 255px; height: 200px;">
                                        </div>
                                        <i class="fa fa-trash fa-2x md-fab m-b waves-effect pull-right pointer eliminar-imagen-instrumental" data-imagenNombre="<?= $DATOS['instrumental_imagen']?>" style="margin-right: 235px; margin-top: -23px;"></i>
                                    </div>
                                </div>
                                <?php }else {?>
                                <div class="col-md-6">
                                    <div class="md-form-group">
                                        <label><b>IMAGEN</b></label>
                                        <input type="file" name="instrumental_imagen" id="vale_evidencias" class="form-control upload-archivo">
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="col-md-6">
                                    <div class="md-form-group">
                                        <label><b>DESCRIPCIÓN</b></label>
                                        <textarea class="form-control" name="instrumental_descripcion" required="" placeholder="" value="" style="height: 34px;"><?= $DATOS['instrumental_descripcion']?></textarea>   
                                    </div>
                                    <input type="hidden" name="csrf_token">
                                    <input type="hidden" name="id_charola" value="<?= $_GET['charola_id']?>">
                                    <input type="hidden" name="id_instrumental" value="<?= $_GET['instrumental_id']?>">
                                    <input type="hidden" name="accion" value="<?= $_GET['accion']?>">
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 30px; margin-top: 30px;">
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
<script type="text/javascript" src="<?= base_url()?>assets/libs/light-bootstrap/shieldui-all.min.js"></script>
<script src="<?= base_url('assets/js/AbsCatalogos.js?').md5(microtime())?>" type="text/javascript"></script>

