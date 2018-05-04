<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12 col-centered"> 
            <ol class="breadcrumb">
                <li><a style="text-transform: uppercase" href="<?= base_url()?>Abasto/MinimaInvacion/CatalogoPrincipalConsumo">Mínima Invasión</a></li>
                <li><a style="text-transform: uppercase" href="<?= base_url()?>Abasto/Catalogos/Sistemas?vale=<?= $_GET['vale']?>"><?=$sistema['sistema_titulo']?></a></li>
                <li><a style="text-transform: uppercase" href="<?= base_url()?>Abasto/Catalogos/Elementos?elemento=<?= $_GET['elemento']?>&sistema=<?=$_GET['sistema']?>&vale=<?= $_GET['vale']?>"><?= substr($elemento['elemento_titulo'], 0,15)?>...</a></li>
                <li><a style="text-transform: uppercase" href="<?= base_url()?>Abasto/Catalogos/Rangos?name=<?= $_GET['name']?>&sistema=<?=$_GET['sistema']?>&rango_id=<?= $_GET['rango_id']?>&elemento=<?= $_GET['elemento']?>&vale=<?= $_GET['vale']?>">RANGOS</a></li>
                <li><a style="text-transform: uppercase" href="#">INVENTARIO</a></li>
            </ol> 
            <div class="panel panel-default">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-align: center!important">
                        <strong>INVENTARIO DE RANGOS</strong>
                    </span>
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase; margin-left: 310px;">
                        <b>TOTAL : <?= count($INVENTARIO)  ?> </b>
                    </span>
                    <a style="margin-left: 30px !important;" href="#" class="md-btn md-fab m-b green waves-effect pull-right tip Agregar-Cantidad" data-original-title="Abastecer">
                        <i class="mdi-content-add i-24" ></i>
                    </a>
                </div>
                <input name="rango_id" type="hidden" value="<?= $_GET['rango_id']?>">
                <input name="sistema_id" type="hidden" value="<?= $_GET['sistema']?>">
                <div class="panel-body b-b b-light">  
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="input-group m-b">
                                    <span class="input-group-addon back-imss no-border">
                                        <i class="fa fa-search"></i>
                                    </span>
                                    <input type="text" id="buscar" name="buscar" class="form-control" placeholder="Buscar Inventario">
                                </div>
                            </div>
                            <div class="col-md-12"><br>
                                <table class="table table-hover table-bordered footable" data-page-size="10" data-filter="#buscar">
                                    <thead>
                                        <tr>
                                            <th>CÓDIGO</th>
                                            <th>RANGO</th>
                                            <th>SISTEMA</th>
                                            <th>PROVEEDOR</th>
                                            <th>STATUS</th>
                                            <th>ACCIÓN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($INVENTARIO as $value) {?>
                                        <tr>
                                            <td><?=$value['inventario_id']?></td>
                                            <td><?=$value['rango_titulo']?></td>
                                            <td><?=$value['sistema_titulo']?></td>
                                            <td><?=$value['sistema_proveedor']?></td>
                                            <td><?=$value['procedimiento_status']?></td>
                                            <td>
                                                <a href="<?=base_url()?>abasto/MinimaInvacion/ImprimirCodigoInsumo?codigo=<?=$value['inventario_id']?>" target="_blank">
                                                    <i class="fa fa-file-pdf-o i-16 icono-accion"></i>
                                                </a>
                                                <?php if($value['procedimiento_status'] != 'ASIGNADA') {?>
                                                &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-trash icono-accion eliminar-insumos_tipo pointer i-16" data-id_dependencia="<?=$_GET['rango_id']?>" data-tipo="Codigo" data-id="<?=$value['inventario_id']?>" data-nombre="<?=$value['inventario_id']?>" title="Eliminar"></i>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                    <tfoot class="hide-if-no-paging">
                                        <tr>
                                            <td colspan="9" id="footerCeldas" class="text-center">
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
