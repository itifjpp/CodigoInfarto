<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12 col-centered"> 
            <ol class="breadcrumb">
                <li><a style="text-transform: uppercase" href="<?= base_url()?>Abasto/MinimaInvacion/CatalogoPrincipalConsumo">Mínima Invasión</a></li>
                <li><a style="text-transform: uppercase" href="<?= base_url()?>Abasto/Catalogos/Sistemas?vale=<?= $_GET['vale']?>&tratamiento_qx=<?=$_GET['tratamiento_qx']?>"><?=$sistema['sistema_titulo']?></a></li>
                <li><a style="text-transform: uppercase" href="#">ELEMENTOS</a></li>
            </ol>
            <div class="row">
                <div class="<?= $_GET['vale'] == 0? 'col-md-12':'col-md-7' ?>">
                    <div class="panel panel-default">
                        <div  style="height: 44em;">
                            <div class="panel-heading p teal-900 back-imss">
                                <span style="font-size: 15px;font-weight: 500;text-align: center!important">
                                    <strong>ELEMENTOS</strong><br>
                                </span>
                                <?php if($_GET['vale'] == 0) {?>
                                <a href="<?=  base_url()?>Abasto/Catalogos/NuevoElemento?sistema=<?=$_GET['sistema']?>&elemento=0&accion=add" class="md-btn md-fab m-b green waves-effect pull-right tip " data-original-title="Nuevos Catalogos">
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
                                                        <th>DESCRIPCIÓN</th>
                                                        <th style="width: 20%">ACCIONES</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($Gestion as $value) {?>
                                                    <tr>
                                                        <td><?=$value['sistema_titulo']?></td>
                                                        <td><?=$value['elemento_titulo']?></td>
                                                        <td>
                                                            <span class="tip pointer" data-original-title="<?=$value['elemento_descripcion']?>"><?= substr($value['elemento_descripcion'], 0,30)?>... </span>
                                                        </td>
                                                        <td>
                                                            <?php if($_GET['vale'] == 0) {?>
                                                            <i class="fa fa-image i-16 icono-accion view-image pointer" data-image="<?= base_url()?>assets/materiales/<?=$value['elemento_img']?>"></i>&nbsp;
                                                            <a href="<?=  base_url()?>Abasto/Catalogos/NuevoElemento?sistema=<?=$_GET['sistema']?>&elemento=<?=$value['elemento_id']?>&accion=edit">
                                                                <i class="fa fa-pencil i-16 icono-accion" ></i>
                                                            </a>
                                                            <?php } ?>
                                                            <a href="<?= base_url()?>Abasto/Catalogos/Rangos?name=<?= $_GET['name']?>&sistema=<?=$value['sistema_id']?>&elemento=<?=$value['elemento_id']?>&vale=<?= $_GET['vale']?>&tratamiento_qx=<?=$_GET['tratamiento_qx']?>">
                                                                <i class="fa fa-sort-numeric-asc i-16 icono-accion tip" data-original-title="Agregar Rangos"></i>
                                                            </a>&nbsp;
                                                            <?php if($value['elemento_status'] != 1) {?>
                                                            &nbsp;
                                                            <i class="fa fa-trash-o i-16 pointer icono-accion eliminar-insumos_tipo" data-tipo="Elemento" data-id="<?=$value['elemento_id']?>" data-id_dependencia="<?=$_GET['sistema']?>" data-nombre="<?=$value['elemento_titulo']?>"></i>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                    <?php }?>
                                                </tbody>
                                                <tfoot class="hide-if-no-paging">
                                                    <tr>
                                                        <td colspan="4" id="footerCeldas" class="text-center">
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