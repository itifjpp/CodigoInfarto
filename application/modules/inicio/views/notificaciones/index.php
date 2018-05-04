<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12">
           <ol class="breadcrumb" style="margin-top: -20px">
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Notificaciones</a></li>
            </ol>    
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">Notificaciones</span>
                    
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group m-b ">
                                <span class="input-group-addon back-imss no-border" ><i class="fa fa-search"></i></span>
                                <input type="text" class="form-control" id="filter" placeholder="Buscar...">
                            </div>
                        </div>
                        
                    </div>
                </div>
                <table class="table m-b-none" ui-jp="footable" data-limit-navigation="7" data-filter="#filter" data-page-size="10">
                    <thead>
                        <tr>
                            <th data-sort-initial="false" data-toggle="true" style="width: 20%">Titulo</th>
                            <th style="width: 30%">Descripción</th>
                            <th >Fecha</th>
                            <th data-hide="phone">Estado</th>
                            <th data-sort-ignore="true" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($Gestion as $value) {?>
                        <?php if(in_array($value['notificacion_para'], $_SESSION['IMSS_ROLES'])){?>                      
                        <tr id="<?=$value['notificacion_id']?>" >
                            <td><?=$value['notificacion_titulo']?></td>
                            <td><?=$value['notificacion_descripcion']?></td>
                            <td><?=$value['notificacion_fecha']?></td>
                            <td>
                                <?php if($value['notificacion_status']=='Nuevo'){?>
                                <span class="label red">Nuevo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                <?php }else{?>
                                <span class="label green">Leido&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                <?php }?>
                            </td>
                            <td class="text-center">
                                <?php if($value['notificacion_url']!=''){?>
                                <a href="<?=  base_url()?><?=$value['notificacion_url']?>" target="_blank">
                                    <i class="fa fa-share-square-o tip icono-accion" data-original-title="Ver enlace de referencia"></i>
                                </a>&nbsp;
                                <?php }?>
                                <?php if($value['notificacion_status']=='Nuevo'){?>
                                <i class="fa fa-check-square-o icono-accion marcar-como-visto tip pointer" data-id="<?=$value['notificacion_id']?>" data-original-title="Marcar Como Visto"></i>
                                <?php }?>
                                <a href="">
                                    <i class="fa fa-share icono-accion tip" data-original-title="Detalles"></i>
                                </a>&nbsp;
                                <i class="fa fa-trash-o icono-accion tip pointer" data-original-title="Eliminar"></i>
                            </td>
                        </tr>
                        <?php }?>
                     <?php } ?>
                    </tbody>
                    <tfoot class="hide-if-no-paging">
                    <tr>
                        <td colspan="7" class="text-center">
                            <ul class="pagination"></ul>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<?= modules::run('menu/footer'); ?>
<script src="<?= base_url('assets/js/os/inicio/notificaciones.js')?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/os/triage/triage.js')?>" type="text/javascript"></script>