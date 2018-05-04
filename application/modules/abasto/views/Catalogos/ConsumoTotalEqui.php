<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-12 col-centered">
            <div class="box-inner padding">
                <ol class="breadcrumb">
                    <li><a style="text-transform: uppercase" href="<?= base_url()?>Abasto/MinimaInvacion/CategoriasInstrumental">Mínima Invasión</a></li>
                    <li><a style="text-transform: uppercase" href="<?= base_url()?>Abasto/MinimaInvacion/Categorias_Ins_Equi?name=<?= $_GET['name']?>"><?= $CATEGORIA['categoria_nombre'] ?></a></li>
                    <li><a style="text-transform: uppercase" href="#">Equipamiento</a></li>
                </ol>
                <div class="panel panel-default">
                    <div class="paciente-sexo-mujer hide" style="background: pink;width: 100%;height: 10px"></div>
                    <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">
                        <b>EQUIPAMIENTO</b>&nbsp;
                    </span>
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase; margin-left: 310px;">
                        <b>TOTAL : <?= count($TOTAL_EQUI)  ?> </b>&nbsp;
                    </span>
                    <a style="margin-left: 30px !important;" href="<?=  base_url()?>Abasto/MinimaInvacion/NuevoEquipamiento?accion=add&name=<?= $_GET['name']?>&categoria_id=<?= $_GET['categoria_id']?>" target="_blank" class="md-btn md-fab m-b green waves-effect pull-right tip " data-original-title="Nuevo Equipamiento">
                        <i class="mdi-content-add i-24" ></i>
                    </a>
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
                                                <th>EQUIPAMIENTO</th>
                                                <th>DESCRIPCIÓN</th>
                                                <th>CANTIDAD DISPONIBLE</th>
                                                <th>ACCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($TOTAL_EQUI AS $value) { ?>
                                            <tr>
                                                <td><?= $value['equipamiento_nombre']?></td>
                                                <td><?= $value['equipamiento_descripcion']?>
                                                </td>
                                                <td><?= $this->config_mdl->_query("SELECT COUNT(abs_cantidad.cantidad_id) AS mas FROM abs_cantidad WHERE
                                                                                   abs_cantidad.cantidad_tipo = 'equipamiento' AND
                                                                                   abs_cantidad.tipo_inst_equi_id=".$value['equipamiento_id'])[0]['mas'];?>
                                                    
                                                    
                                                </td>
                                                <td>
                                                    &nbsp;<a href="<?=base_url()?>Abasto/MinimaInvacion/NuevoEquipamiento?accion=edit&equipamiento_id=<?= $value['equipamiento_id']?>" target="_blank">
                                                        <i class="fa fa-pencil i-16 pointer" title="Editar"></i>
                                                    </a>
                                                    <?php if($value['equipamiento_status'] != 1) { ?>
                                                    &nbsp;<i class="fa fa-trash icono-accion i-16 pointer eliminar-instrumentaOEquip" data-tipo="equipamiento" data-nombre="<?= $value['equipamiento_nombre']?>" data-id="<?= $value['equipamiento_id']?>" data-id_dependencia="<?= $_GET['categoria_id']?>" title="Eliminar"></i>
                                                    <?php }?>
                                                    &nbsp;<a href="<?=base_url()?>Abasto/MinimaInvacion/Cantidades?name=<?= $_GET['name']?>&categoria_id=<?= $_GET['categoria_id']?>&equipamiento_id=<?= $value['equipamiento_id']?>" target="_blank" title="Cantidad">
                                                        <i class="fa fa-plus-square icono-accion i-16"></i>
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


