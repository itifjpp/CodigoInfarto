<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12 col-centered">
            <ol class="breadcrumb">
                <li><a style="text-transform: uppercase" href="<?= base_url()?>Abasto/MinimaInvacion/CatalogoPrincipalConsumo">Mínima Invasión</a></li>
                <li><a style="text-transform: uppercase" href="<?= base_url()?>Abasto/MinimaInvacion/Categorias_Ins_Equi?name=<?= $_GET['name']?>"><?= $CATEGORIA['categoria_nombre']?></a></li>
                <?php if($INSTRUMENTAL['instrumental_nombre'] != '') {?>
                <li><a style="text-transform: uppercase" href="<?= base_url()?>Abasto/MinimaInvacion/Charolas?name=<?= $_GET['name']?>&categoria_id=<?= $_GET['categoria_id']?>"><?= $CHAROLA['charola_nombre']?></a></li>
                <li><a style="text-transform: uppercase" href="<?= base_url()?>Abasto/MinimaInvacion/ConsumoTotalInst?name=<?= $_GET['name']?>&categoria_id=<?= $_GET['categoria_id']?>&charola_id=<?= $_GET['charola_id']?>"><?= $INSTRUMENTAL['instrumental_nombre']?></a></li>
                <?php } else {?>
                <li><a style="text-transform: uppercase" href="<?= base_url()?>Abasto/MinimaInvacion/ConsumoTotalEqui?name=<?= $_GET['name']?>&categoria_id=<?= $_GET['categoria_id']?>&equipamiento_id=<?= $_GET['equipamiento_id']?>"><?= $EQUIPAMIENTO['equipamiento_nombre']?></a></li>
                <?php } ?>
                <li><a style="text-transform: uppercase" href="#">Inventarío</a></li>
            </ol>
            <div class="panel panel-default">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-align: center!important">
                        <strong>INVENTARIO EQUIPAMIENTO E INSTRUMENTAL</strong>
                    </span>
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase; margin-left: 310px;">
                        <b>TOTAL : <?= count($TOTAL_CANTIDAD)  ?> </b>&nbsp;
                    </span>
                    <a style="margin-left: 30px !important;" class="md-btn md-fab m-b green waves-effect pull-right tip Agregar-Cantidad" data-original-title="Agregar">
                        <i class="mdi-content-add i-24" ></i>
                    </a>
                    <input type="hidden" name="instrumental_id" value="<?= $_GET['instrumental_id']?>">           
                    <input type="hidden" name="equipamiento_id" value="<?= $_GET['equipamiento_id']?>"> 
                </div>
                <div class="panel-body b-b b-light">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="input-group m-b">
                                        <span class="input-group-addon back-imss no-border" ><i class="fa fa-search"></i></span>
                                        <input type="text" class="form-control" id="buscar" name="procedimiento" placeholder="BUSCAR PROCEDIMIENTO">
                                    </div>
                                </div>
                                <div class="col-md-12"><br>
                                    <table class="table table-hover table-bordered footable table-filtros" data-page-size="7" data-filter="#buscar" style="font-size: 13px">
                                        <thead>
                                            <tr>
                                                <th>CÓDIGO</th>
                                                <th>INTERVENCIONES</th>
                                                <th>ACCIÓN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            if(isset($_GET['instrumental_id'])){
                                                foreach ($TOTAL_CANTIDAD as $value) {?>
                                                <tr>
                                                    <td><?=$value['cantidad_id']?></td>
                                                    <td>
                                                        <?= $this->config_mdl->_query("SELECT COUNT(abs_instrumental_procedimiento.vale_servicio_id) 
                                                                                        AS result
                                                                                        FROM abs_instrumental_procedimiento 
                                                                                        WHERE abs_instrumental_procedimiento.cantidad_id =".$value['cantidad_id']."
                                                                                        AND abs_instrumental_procedimiento.vale_servicio_id != 0")[0]['result'];?>
                                                    </td>
                                                    <td><center>
                                                            <a href="<?=base_url()?>abasto/MinimaInvacion/ImprimirCodigoInsumo?codigo=<?=$value['cantidad_id']?>" target="_blank">
                                                                <i class="fa fa-file-pdf-o i-16 icono-accion"></i>
                                                            </a>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-trash eliminar-cantidad pointer i-16 icono-accion" data-id="<?=$value['cantidad_id']?>" data-id_dependencia="<?= $_GET['instrumental_id']?>" data-tipo="instrumental" title="Eliminar"></i>
                                                        </center>
                                                    </td>
                                                </tr>
                                            <?php 
                                                }
                                            }else if(isset($_GET['equipamiento_id'])) {
                                                foreach ($TOTAL_CANTIDAD as $value) 
                                                {
                                            ?>
                                                <tr>
                                                    <td><?=$value['cantidad_id']?></td>
                                                    <td>
                                                        <?= $this->config_mdl->_query("SELECT COUNT(abs_equipamiento_procedimiento.vale_servicio_id) 
                                                                                        AS result
                                                                                        FROM abs_equipamiento_procedimiento 
                                                                                        WHERE abs_equipamiento_procedimiento.cantidad_id =".$value['cantidad_id']."
                                                                                        AND abs_equipamiento_procedimiento.vale_servicio_id != 0")[0]['result'];?>
                                                    </td>
                                                    <td><center>
                                                            <a href="<?=base_url()?>abasto/MinimaInvacion/ImprimirCodigoInsumo?codigo=<?=$value['cantidad_id']?>" target="_blank">
                                                                <i class="fa fa-file-pdf-o i-16 icono-accion"></i>
                                                            </a>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-trash eliminar-cantidad pointer i-16 icono-accion" data-id="<?=$value['cantidad_id']?>" data-tipo="equipamiento" data-id_dependencia="<?= $_GET['equipamiento_id']?>" title="Eliminar"></i>
                                                        </center>
                                                    </td>
                                                </tr>
                                            <?php 
                                                }
                                            }else {
                                                foreach ($TOTAL_CANTIDAD as $value) 
                                                {
                                            ?>
                                                <tr>
                                                    <td><?=$value['cantidad_id']?></td>
                                                    <td>
                                                        <?= $this->config_mdl->_query("SELECT COUNT(abs_instrumental_procedimiento.instrumental_id) 
                                                                                        AS result
                                                                                        FROM abs_instrumental_procedimiento 
                                                                                        WHERE abs_instrumental_procedimiento.cantidad_id =".$value['cantidad_id'])[0]['result'];?>
                                                    </td>
                                                    <td><center>
                                                            <a href="<?=base_url()?>abasto/MinimaInvacion/ImprimirCodigoInsumo?codigo=<?=$value['cantidad_id']?>" target="_blank">
                                                                <i class="fa fa-file-pdf-o i-16 icono-accion"></i>
                                                            </a>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-trash eliminar-equipamiento pointer i-16 icono-accion" title="Eliminar"></i>
                                                        </center>
                                                    </td>
                                                </tr>
                                            <?php 
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    <tfoot class="hide-if-no-paging">
                                        <tr>
                                            <td colspan="3" id="footerCeldas" class="text-center">
                                                <ul class="pagination"></ul>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/AbsCatalogos.js?').md5(microtime())?>" type="text/javascript"></script>

