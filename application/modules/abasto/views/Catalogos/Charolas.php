<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-12 col-centered">
            <div class="box-inner padding">
                <div class="box-inner padding">
                <ol class="breadcrumb">
                    <li><a style="text-transform: uppercase" href="<?= base_url()?>Abasto/MinimaInvacion/CatalogoPrincipalConsumo">Mínima Invasión</a></li>
                    <li><a style="text-transform: uppercase" href="<?= base_url()?>Abasto/MinimaInvacion/Categorias_Ins_Equi?name=<?= $_GET['name']?>"><?= $CATEGORIA['categoria_nombre']?></a></li>
                    <li><a style="text-transform: uppercase" href="#">CHAROLAS</a></li>
                </ol>
                <div class="panel panel-default">
                    <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">
                        <b>CHAROLAS</b>&nbsp;
                    </span>
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase; margin-left: 310px;">
                        <b>TOTAL : <?= count($CHAROLAS)?> </b>&nbsp;
                    </span>
                    <a style="margin-left: 30px !important;" href="<?=  base_url()?>Abasto/MinimaInvacion/NuevaCharola?accion=add&name=<?=$_GET['name']?>&categoria_id=<?= $_GET['categoria_id']?>" target="_blank" class="md-btn md-fab m-b green waves-effect pull-right tip " data-original-title="Nuevo Charola">
                        <i class="mdi-content-add i-24"></i>
                    </a>
                </div>
                    <div class="panel-body b-b b-light">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="input-group m-b">
                                        <span class="input-group-addon back-imss no-border" ><i class="fa fa-search"></i></span>
                                        <input type="text" class="form-control" id="buscar" name="procedimiento" placeholder="BUSCAR CHAROLA">
                                    </div>
                                </div>
                                <div class="col-md-12"><br>
                                    <table class="table table-hover table-bordered footable table-filtros" data-page-size="7" data-filter="#buscar" style="font-size: 13px">
                                        <thead>
                                            <tr>
                                                <th>NOMBRE</th>
                                                <th>DESCRIPCIÓN</th>
                                                <th>CATEGORÍA</th>
                                                <th style="width: 20%;">ACCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($CHAROLAS AS $value) { ?>
                                            <tr>
                                                <td><?= $value['charola_nombre']?></td>
                                                <td><?= $value['charola_descripcion']?></td>
                                                <td><?= $value['categoria_nombre']?></td>
                                                <td>
                                                    &nbsp;<a href="<?=base_url()?>Abasto/MinimaInvacion/NuevaCharola?accion=edit&name=<?= $_GET['name']?>&categoria_id=<?= $_GET['categoria_id']?>&charola_id=<?= $value['charola_id']?>" target="_blank">
                                                        <i class="fa fa-pencil i-16 pointer icono-accion"></i>
                                                    </a>
                                                    <?php if($value['charola_status'] != 1) { ?>
                                                    &nbsp;<i class="fa fa-trash i-16 icono-accion eliminar-charola pointer" data-charola_id="<?= $value['charola_id']?>" data-charola="<?= $value['charola_nombre']?>" data-id_dependencia="<?= $_GET['categoria_id']?>"></i>
                                                    <?php } ?>
                                                    &nbsp;<a href="<?=base_url()?>Abasto/MinimaInvacion/ConsumoTotalInst?name=<?= $_GET['name']?>&categoria_id=<?= $_GET['categoria_id']?>&charola_id=<?= $value['charola_id']?>"> 
                                                        <i class="fa fa-mail-forward i-16 icono-accion"></i>
                                                    </a>
                                                </td>
                                           </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot class="hide-if-no-paging">
                                            <tr>
                                                <td colspan="4" id="footerCeldas" class="text-center">
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
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/AbsCatalogos.js?').md5(microtime())?>" type="text/javascript"></script>



