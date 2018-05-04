<?= modules::run('Sections/Menu/index'); ?>  
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-12 col-centered">
            <div class="box-inner padding">
                <ol class="breadcrumb">
                    <li><a style="text-transform: uppercase" href="<?= base_url()?>Abasto/MinimaInvacion/CategoriasInstrumental">Mínima Invasión</a></li>
                    <li><a style="text-transform: uppercase" href="<?= base_url()?>Abasto/MinimaInvacion/Categorias_Ins_Equi?name=<?= $_GET['name']?>">Categoría</a></li>
                    <li><a style="text-transform: uppercase" href="#"> <?= $_GET['categoria']?> </a></li>
                    <li><a style="text-transform: uppercase" href="#"> <?= $_GET['accion'] == 'edit'?'EDITAR':'NUEVO'; ?> EQUIPAMIENTO</a></li>
                </ol>
                <div class="panel panel-default ">
                    <div class="panel-heading p teal-900 back-imss">
                        <span style="font-size: 15px;font-weight: 500;text-transform: uppercase"><b><?= $_GET['accion'] == 'edit'?'EDITAR':'NUEVO'; ?> EQUIPAMIENTO</b></span>
                    </div>
                    <div class="panel-body b-b b-light">
                        <form class="guardar-equipamiento">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="md-form-group">
                                        <label><b>NO. DE SERIE</b></label>
                                        <input class="form-control" name="equipamiento_serie" type="number" required="" placeholder="" value="<?= $DATOS['equipamiento_serie']?>">   
                                    </div>
                                </div>
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
                                <div class="col-md-6">
                                    <div class="md-form-group">
                                        <label><b>NOMBRE DEL EQUIPAMIENTO</b></label>
                                        <input class="form-control" name="equipamiento_nombre" required="" placeholder="NOMBRE DEL EQUIPAMIENTO" value="<?= $DATOS['equipamiento_nombre']?>">   
                                    </div>
                                </div>
                                <?php if(isset($_GET['equipamiento_id'])) { ?>
                                <div class="col-md-6">
                                    <div id="imagenNew_inst_equip" class="md-form-group hidden">
                                        <label><b>IMAGEN</b></label>
                                        <input type="file" name="equipamiento_imagen" id="vale_evidencias" class="form-control upload-archivo">
                                    </div>
                                    <div id="imagen_inst_equip" class="" style="margin-top: 20px;"><label><b>IMAGEN</b></label>
                                        <div class="md-form-group" style="margin-top: -18px;">
                                            <img src="<?= base_url()?>assets/evidencias_procedimiento/<?= $DATOS['equipamiento_imagen']?>" style="width: 255px; height: 200px;">
                                        </div>
                                        <i class="fa fa-trash fa-2x md-fab m-b waves-effect pull-right pointer eliminar-imagen-instrumental" data-imagenNombre="<?= $DATOS['equipamiento_imagen']?>" style="margin-right: 235px; margin-top: -23px;"></i>
                                    </div>
                                </div>
                                <?php }else {?>
                                <div class="col-md-6">
                                    <div class="md-form-group">
                                        <label><b>IMAGEN</b></label>
                                        <input type="file" name="equipamiento_imagen" id="vale_evidencias" class="form-control upload-archivo">
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="col-md-6">
                                    <div class="md-form-group">
                                        <label><b>DESCRIPCIÓN</b></label>
                                        <textarea class="form-control" name="equipamiento_descripcion" required="" placeholder="" style="height: 34px;"><?= $DATOS['equipamiento_descripcion']?></textarea>   
                                    </div>
                                </div>
                            </div>
                            <div class="row"><br><br>
                                <div class="col-md-6 col-md-offset-6">
                                    <input type="hidden" name="categoria_id" value="<?= $_GET['categoria_id']?>">
                                    <input type="hidden" name="id_equipamiento" value="<?= $_GET['equipamiento_id']?>">
                                    <input type="hidden" name="accion" value="<?= $_GET['accion']?>">
                                    <input type="hidden" name="csrf_token">
                                    <button type="submit" class="md-btn md-raised m-b btn-fw back-imss waves-effect no-text-transform pull-right" style="margin-bottom: -10px">GUARDAR</button>                     
                                </div><br><br><br>
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

