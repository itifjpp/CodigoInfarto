<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12 col-centered"> 
            <ol class="breadcrumb">
                <li><a style="text-transform: uppercase" href="<?= base_url()?>Abasto/MinimaInvacion/CatalogoPrincipalConsumo">Mínima Invasión</a></li>
                <li><a style="text-transform: uppercase" href="<?= base_url()?>Abasto/Catalogos/Sistemas?vale=<?= $_GET['vale']?>&tratamiento_qx=<?=$_GET['tratamiento_qx']?>"><?=$sistema['sistema_titulo']?></a></li>
                <li><a style="text-transform: uppercase" href="<?= base_url()?>Abasto/Catalogos/Elementos?sistema=<?=$_GET['sistema']?>&vale=<?= $_GET['vale']?>&tratamiento_qx=<?=$_GET['tratamiento_qx']?>"><?= substr($elemento['elemento_titulo'], 0,15)?>...</a></li>
                <li><a style="text-transform: uppercase" href="#">RANGOS</a></li>
            </ol>
            <div class="row">
                <div class="<?= $_GET['vale'] == 0? 'col-md-12':'col-md-7' ?>">
                    <div class="panel panel-default">
                        <div  style="height: 44em;">
                            <div class="panel-heading p teal-900 back-imss">
                                <span style="font-size: 15px;font-weight: 500;text-align: center!important">
                                    <strong>RANGOS</strong>
                                </span>
                                <?php if($_GET['vale'] == 0) {?>
                                <a href="<?=  base_url()?>Abasto/Catalogos/NuevoRango?sistema=<?=$_GET['sistema']?>&elemento=<?=$_GET['elemento']?>&rango=0&accion=add" class="md-btn md-fab m-b green waves-effect pull-right tip " data-original-title="Nuevo Rango">
                                    <i class="mdi-content-add i-24" ></i>
                                </a>
                                <?php } ?>
                            </div>
                            <div class="panel-body b-b b-light">     
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-7" style="margin-top: -20px;">
                                            <div class="input-group m-b">
                                                <span class="input-group-addon back-imss no-border">
                                                    <i class="fa fa-search"></i>
                                                </span>
                                                <input type="text" name="elemento_id" class="form-control" placeholder="Buscar Elemento">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <table class="table table-hover table-bordered footable" data-page-size="4" data-filter="#elemento_id" style="font-size: 12px">
                                                <thead>
                                                    <tr>
                                                        <th>SISTEMA</th>
                                                        <th>ELEMENTO</th>
                                                        <th>RANGO</th>
                                                        <th>DESCRIPCIÓN</th>
                                                        <th style="width: 20%;">ACCIONES</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($Gestion as $value) {?>
                                                    <tr>
                                                        <td><?=$value['sistema_titulo']?></td>
                                                        <td><?=$value['elemento_titulo']?></td>
                                                        <td><?=$value['rango_titulo']?></td>
                                                        <td><?=$value['rango_descripcion']?></td>
                                                        <td>
                                                            <?php if($_GET['vale'] == 0) {?>
                                                            <i class="fa fa-image icono-accion i-16 view-image pointer" data-image="<?= base_url()?>assets/materiales/<?=$value['rango_img']?>"></i>&nbsp;&nbsp;
                                                            <a href="<?=  base_url()?>Abasto/Catalogos/NuevoRango?sistema=<?=$_GET['sistema']?>&elemento=<?=$_GET['elemento']?>&rango=<?=$value['rango_id']?>&accion=edit">
                                                                <i class="fa fa-pencil i-16 icono-accion" ></i>
                                                            </a>&nbsp;
                                                            <a href="<?=base_url()?>Abasto/MinimaInvacion/RangosInventario?rango_id=<?= $value['rango_id']?>&name=<?= $_GET['name']?>&sistema=<?= $_GET['sistema']?>&elemento=<?= $_GET['elemento']?>&vale=<?= $_GET['vale']?>" target="_blank" title="Cantidad">
                                                                <i class="fa fa-plus-square i-16 icono-accion"></i>
                                                            </a>
                                                            <?php } else {?>
                                                                <i class="fa fa-plus-circle pointer i-16 icono-accion agregarOsteosintesis" data-tratamiento_qx="<?= $_GET['tratamiento_qx']?>" data-id_rango='<?= $value['rango_id']?>' data-id_elemento='<?= $_GET['elemento']?>' data-id_sistema='<?= $_GET['sistema']?>' data-vale='<?= $_GET['vale']?>'></i>
                                                            <?php } ?>
                                                            <?php if($value['rangos_status'] != 1 && $_GET['vale'] == 0) {?>
                                                            &nbsp;&nbsp;<i class="fa fa-trash-o pointer i-16 icono-accion eliminar-insumos_tipo" data-tipo="Rango" data-id="<?=$value['rango_id']?>" data-id_dependencia="<?=$_GET['elemento']?>" data-nombre="<?=$value['rango_titulo']?>"></i>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                    <?php }?>
                                                </tbody>
                                                <tfoot class="hide-if-no-paging">
                                                        <tr>
                                                           <td colspan="5" id="footerCeldas" class="text-center">
                                                                <?php if($total['total'] >= 4) {?>
                                                                <ul></ul>
                                                                <?php } else if($total['total'] == 3) { ?>
                                                                <ul style="height: 4em;"></ul>
                                                                <?php } else if($total['total'] == 2) { ?>
                                                                <ul style="height: 8em;"></ul>
                                                                <?php } else if($total['total'] == 1) { ?>
                                                                <ul style="height: 10em;"></ul>
                                                                <?php } else if($total['total'] == 0) { ?>
                                                                <ul style="height: 12em;"></ul>
                                                                <?php } ?>
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
                <div class="<?= $_GET['vale'] == 0? 'hidden':'col-md-5' ?>">
                    <div class="panel panel-default">
                        <div  style="height: 44em;">
                            <div class="panel-heading p teal-900 back-imss">
                               <span style="font-size: 15px;font-weight: 500;text-align: center!important">
                                   <center><strong>VALE DE SERVICIO</strong></center>
                               </span>
                            </div>
                             <div class="panel-body b-b b-light">   
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12" style="margin-top: 27px;">
                                            <table class="table table-hover table-bordered footable" data-page-size="4" data-filter="#elemento_id" style="font-size: 12px">
                                               <thead>
                                                   <tr>
                                                       <th>SISTEMA</th>
                                                       <th>RANGO</th>
                                                       <th>CANTIDAD</th>
                                                   </tr>
                                               </thead>
                                               <tbody>
                                                   <?php foreach ($Gestion as $value) {?>
                                                   <tr>
                                                       <td>
                                                           <span class="tip pointer" data-original-title="<?=$value['sistema_titulo']?>"><?= substr($value['sistema_titulo'], 0, 4)?></span>...
                                                       </td>
                                                       <td>
                                                            <span class="tip pointer" data-original-title="<?=$value['rango_titulo']?>"><?= substr($value['rango_titulo'] , 0, 4)?></span>...
                                                       </td>
                                                       <?php $TOTAL_PETI = $this->config_mdl->_query("SELECT COUNT(abs_solicitud_osteo.peticion_id) AS total FROM abs_solicitud_osteo WHERE abs_solicitud_osteo.rango_id = ".$value['rango_id'])[0];?>
                                                       <?php if($TOTAL_PETI['total']) { ?>
                                                       <td> <?= $TOTAL_PETI['total']?>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-trash-o pointer eliminar-peticion_osteo" data-id="<?=$value['peticion_id']?>"></i></td>
                                                       <?php } ?>
                                                   </tr>
                                                   <?php }?>
                                               </tbody>
                                               <tfoot class="hide-if-no-paging">
                                                   <tr>
                                                       <td colspan="3" id="footerCeldas" class="text-center">
                                                            <?php if($total_inv['total'] >= 4) {?>
                                                            <ul></ul>
                                                            <?php } else if($total_inv['total'] == 3) { ?>
                                                            <ul style="height: 4em;"></ul>
                                                            <?php } else if($total_inv['total'] == 2) { ?>
                                                            <ul style="height: 8em;"></ul>
                                                            <?php } else if($total_inv['total'] == 1) { ?>
                                                            <ul style="height: 10em;"></ul>
                                                            <?php } else if($total_inv['total'] == 0) { ?>
                                                            <ul style="height: 12em;"></ul>
                                                            <?php } ?>
                                                           <ul class="pagination"></ul>
                                                       </td>
                                                   </tr>
                                               </tfoot>
                                           </table>
                                        </div>
                                        <div class="col-md-1 col-md-offset-2"> <a href="<?=base_url()?>Abasto/MinimaInvacion/ImprimirInventarioOsteo?vale=<?= $_GET['vale']?>" target="_blank"><i class="fa fa-file-pdf-o i-20"></i></a> </div>
                                        <div class="col-md-6 col-md-offset-1"> <input type="button" class="md-btn md-raised m-b btn-fw back-imss waves-effect no-text-transform pull-right terminar_peticion_osteo" data-vale="<?= $_GET['vale']?>" style="margin-bottom: -10px" value="TERMINAR"></div>                     
                                    </div>
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